<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Client;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Core\Util;
use Vatsense\RequestOptions;
use Vatsense\ServiceContracts\ValidateContract;
use Vatsense\Validate\ValidateCheckResponse;

/**
 * VAT and EORI number validation.
 *
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
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
     * It also returns the `412`, uncounted, when a check takes longer than 55
     * seconds for a number checked with VIES or the EU EORI service, or 25 seconds
     * for any other. With a webhook endpoint taking `validation.completed`, a
     * number that got the `412` keeps being checked and the answer is sent by
     * webhook (https://vatsense.com/documentation#webhooks).
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
     * @param string $matchAddress The whole address you hold, as one line, matched against the registered address.
     * @param string $matchCity The town or city you hold, looked for in the registered address.
     * @param string $matchCompanyName The company name you hold, matched against the registered name. Legal forms such as Ltd or GmbH, accents, punctuation and word order are ignored. Sending any `match_` parameter adds `match` to the response; matching costs nothing extra.
     * @param string $matchPostcode The postcode you hold, looked for in the registered address. Spaces are ignored.
     * @param string $matchStreet The street line you hold, looked for in the registered address.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function check(
        ?string $eoriNumber = null,
        ?string $requesterVatNumber = null,
        ?string $vatNumber = null,
        RequestOptions|array|null $requestOptions = null,
        ?string $matchAddress = null,
        ?string $matchCity = null,
        ?string $matchCompanyName = null,
        ?string $matchPostcode = null,
        ?string $matchStreet = null,
    ): ValidateCheckResponse {
        $params = Util::removeNulls(
            [
                'eoriNumber' => $eoriNumber,
                'requesterVatNumber' => $requesterVatNumber,
                'vatNumber' => $vatNumber,
                'matchAddress' => $matchAddress,
                'matchCity' => $matchCity,
                'matchCompanyName' => $matchCompanyName,
                'matchPostcode' => $matchPostcode,
                'matchStreet' => $matchStreet,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->check(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
