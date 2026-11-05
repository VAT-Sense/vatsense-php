<?php

declare(strict_types=1);

namespace Vatsense\ServiceContracts;

use Vatsense\Core\Exceptions\APIException;
use Vatsense\RequestOptions;
use Vatsense\Validate\ValidateCheckResponse;

/**
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
interface ValidateContract
{
    /**
     * @api
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
    ): ValidateCheckResponse;
}
