<?php

declare(strict_types=1);

namespace Vatsense\Validate;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Concerns\SdkParams;
use Vatsense\Core\Contracts\BaseModel;

/**
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
 * @see Vatsense\Services\ValidateService::check()
 *
 * @phpstan-type ValidateCheckParamsShape = array{
 *   eoriNumber?: string|null,
 *   requesterVatNumber?: string|null,
 *   vatNumber?: string|null,
 *   matchAddress?: string|null,
 *   matchCity?: string|null,
 *   matchCompanyName?: string|null,
 *   matchPostcode?: string|null,
 *   matchStreet?: string|null,
 * }
 */
final class ValidateCheckParams implements BaseModel
{
    /** @use SdkModel<ValidateCheckParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The EORI number to validate. Must include the leading 2-character
     * country code (e.g. "GB123456789123"). UK and EU only.
     */
    #[Optional]
    public ?string $eoriNumber;

    /**
     * Your own VAT number. If supplied, the response will include a unique
     * consultation number issued by the relevant authority (VIES or HMRC).
     * Must include the leading 2-character country code.
     *
     * Note: GB requester numbers only work for GB validations; EU requester
     * numbers only work for EU validations. Cross-region is not supported.
     */
    #[Optional]
    public ?string $requesterVatNumber;

    /**
     * The VAT number to validate. Must include the leading 2-character
     * country code (e.g. "GB288305674", "FR12345678901").
     */
    #[Optional]
    public ?string $vatNumber;

    /**
     * The whole address you hold, as one line, matched against the registered
     * address.
     */
    #[Optional]
    public ?string $matchAddress;

    /**
     * The town or city you hold, looked for in the registered address.
     */
    #[Optional]
    public ?string $matchCity;

    /**
     * The company name you hold, matched against the registered name. Legal
     * forms such as Ltd or GmbH, accents, punctuation and word order are
     * ignored. Sending any `match_` parameter adds `match` to the response;
     * matching costs nothing extra.
     */
    #[Optional]
    public ?string $matchCompanyName;

    /**
     * The postcode you hold, looked for in the registered address. Spaces are
     * ignored.
     */
    #[Optional]
    public ?string $matchPostcode;

    /**
     * The street line you hold, looked for in the registered address.
     */
    #[Optional]
    public ?string $matchStreet;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $eoriNumber = null,
        ?string $requesterVatNumber = null,
        ?string $vatNumber = null,
        ?string $matchAddress = null,
        ?string $matchCity = null,
        ?string $matchCompanyName = null,
        ?string $matchPostcode = null,
        ?string $matchStreet = null,
    ): self {
        $self = new self;

        null !== $eoriNumber && $self['eoriNumber'] = $eoriNumber;
        null !== $requesterVatNumber && $self['requesterVatNumber'] = $requesterVatNumber;
        null !== $vatNumber && $self['vatNumber'] = $vatNumber;
        null !== $matchAddress && $self['matchAddress'] = $matchAddress;
        null !== $matchCity && $self['matchCity'] = $matchCity;
        null !== $matchCompanyName && $self['matchCompanyName'] = $matchCompanyName;
        null !== $matchPostcode && $self['matchPostcode'] = $matchPostcode;
        null !== $matchStreet && $self['matchStreet'] = $matchStreet;

        return $self;
    }

    /**
     * The EORI number to validate. Must include the leading 2-character
     * country code (e.g. "GB123456789123"). UK and EU only.
     */
    public function withEoriNumber(string $eoriNumber): self
    {
        $self = clone $this;
        $self['eoriNumber'] = $eoriNumber;

        return $self;
    }

    /**
     * Your own VAT number. If supplied, the response will include a unique
     * consultation number issued by the relevant authority (VIES or HMRC).
     * Must include the leading 2-character country code.
     *
     * Note: GB requester numbers only work for GB validations; EU requester
     * numbers only work for EU validations. Cross-region is not supported.
     */
    public function withRequesterVatNumber(string $requesterVatNumber): self
    {
        $self = clone $this;
        $self['requesterVatNumber'] = $requesterVatNumber;

        return $self;
    }

    /**
     * The VAT number to validate. Must include the leading 2-character
     * country code (e.g. "GB288305674", "FR12345678901").
     */
    public function withVatNumber(string $vatNumber): self
    {
        $self = clone $this;
        $self['vatNumber'] = $vatNumber;

        return $self;
    }

    /**
     * The whole address you hold, as one line, matched against the registered
     * address.
     */
    public function withMatchAddress(string $matchAddress): self
    {
        $self = clone $this;
        $self['matchAddress'] = $matchAddress;

        return $self;
    }

    /**
     * The town or city you hold, looked for in the registered address.
     */
    public function withMatchCity(string $matchCity): self
    {
        $self = clone $this;
        $self['matchCity'] = $matchCity;

        return $self;
    }

    /**
     * The company name you hold, matched against the registered name. Legal
     * forms such as Ltd or GmbH, accents, punctuation and word order are
     * ignored. Sending any `match_` parameter adds `match` to the response;
     * matching costs nothing extra.
     */
    public function withMatchCompanyName(string $matchCompanyName): self
    {
        $self = clone $this;
        $self['matchCompanyName'] = $matchCompanyName;

        return $self;
    }

    /**
     * The postcode you hold, looked for in the registered address. Spaces are
     * ignored.
     */
    public function withMatchPostcode(string $matchPostcode): self
    {
        $self = clone $this;
        $self['matchPostcode'] = $matchPostcode;

        return $self;
    }

    /**
     * The street line you hold, looked for in the registered address.
     */
    public function withMatchStreet(string $matchStreet): self
    {
        $self = clone $this;
        $self['matchStreet'] = $matchStreet;

        return $self;
    }
}
