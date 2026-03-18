<?php

declare(strict_types=1);

namespace VatsenseVatsense\Validate;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Concerns\SdkParams;
use VatsenseVatsense\Core\Contracts\BaseModel;

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
 *
 * Provide either `vat_number` or `eori_number`, but not both.
 *
 * @see VatsenseVatsense\Services\ValidateService::check()
 *
 * @phpstan-type ValidateCheckParamsShape = array{
 *   eoriNumber?: string|null,
 *   requesterVatNumber?: string|null,
 *   vatNumber?: string|null,
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
    ): self {
        $self = new self;

        null !== $eoriNumber && $self['eoriNumber'] = $eoriNumber;
        null !== $requesterVatNumber && $self['requesterVatNumber'] = $requesterVatNumber;
        null !== $vatNumber && $self['vatNumber'] = $vatNumber;

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
}
