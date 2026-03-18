<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Services;

use VatsenseVatsensePhp\Client;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Core\Util;
use VatsenseVatsensePhp\RequestOptions;
use VatsenseVatsensePhp\ServiceContracts\ValidateContract;
use VatsenseVatsensePhp\Validate\ValidateCheckResponse;

/**
 * VAT and EORI number validation.
 *
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
final class ValidateService implements ValidateContract
{
    /**
     * @api
     */
    public ValidateRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ValidateRawService($client);
    }

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
     * @param string $eoriNumber The EORI number to validate. Must include the leading 2-character
     * country code (e.g. "GB123456789123"). UK and EU only.
     * @param string $requesterVatNumber Your own VAT number. If supplied, the response will include a unique
     * consultation number issued by the relevant authority (VIES or HMRC).
     * Must include the leading 2-character country code.
     *
     * Note: GB requester numbers only work for GB validations; EU requester
     * numbers only work for EU validations. Cross-region is not supported.
     * @param string $vatNumber The VAT number to validate. Must include the leading 2-character
     * country code (e.g. "GB288305674", "FR12345678901").
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function check(
        ?string $eoriNumber = null,
        ?string $requesterVatNumber = null,
        ?string $vatNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): ValidateCheckResponse {
        $params = Util::removeNulls(
            [
                'eoriNumber' => $eoriNumber,
                'requesterVatNumber' => $requesterVatNumber,
                'vatNumber' => $vatNumber,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->check(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
