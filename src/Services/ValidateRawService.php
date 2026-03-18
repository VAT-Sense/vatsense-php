<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Client;
use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Core\Util;
use Vatsense\RequestOptions;
use Vatsense\ServiceContracts\ValidateRawContract;
use Vatsense\Validate\ValidateCheckParams;
use Vatsense\Validate\ValidateCheckResponse;

/**
 * VAT and EORI number validation.
 *
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
final class ValidateRawService implements ValidateRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Check whether a given VAT number or EORI number is valid against live
     * government records.
     *
     * **VAT validation** checks against UK (HMRC), EU (VIES), Australia, Norway,
     * Switzerland, South Africa, and Brazil records.
     *
     * **EORI validation** checks against UK and EU records only.
     *
     * If the external validation service is temporarily unavailable, the API
     * returns a `412` error and the request does not count against your usage quota.
     *
     * Provide either `vat_number` or `eori_number`, but not both.
     *
     * @param array{
     *   eoriNumber?: string, requesterVatNumber?: string, vatNumber?: string
     * }|ValidateCheckParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ValidateCheckResponse>
     *
     * @throws APIException
     */
    public function check(
        array|ValidateCheckParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ValidateCheckParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'validate',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'eoriNumber' => 'eori_number',
                    'requesterVatNumber' => 'requester_vat_number',
                    'vatNumber' => 'vat_number',
                ],
            ),
            options: $options,
            convert: ValidateCheckResponse::class,
        );
    }
}
