<?php

declare(strict_types=1);

namespace VatsenseVatsense\ServiceContracts;

use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\RequestOptions;
use VatsenseVatsense\Validate\ValidateCheckResponse;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function check(
        ?string $eoriNumber = null,
        ?string $requesterVatNumber = null,
        ?string $vatNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): ValidateCheckResponse;
}
