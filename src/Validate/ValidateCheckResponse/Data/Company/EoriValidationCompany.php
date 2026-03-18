<?php

declare(strict_types=1);

namespace Vatsense\Validate\ValidateCheckResponse\Data\Company;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type EoriValidationCompanyShape = array{
 *   companyAddress?: string|null,
 *   companyName?: string|null,
 *   countryCode?: string|null,
 *   eoriNumber?: string|null,
 * }
 */
final class EoriValidationCompany implements BaseModel
{
    /** @use SdkModel<EoriValidationCompanyShape> */
    use SdkModel;

    #[Optional('company_address')]
    public ?string $companyAddress;

    #[Optional('company_name')]
    public ?string $companyName;

    #[Optional('country_code')]
    public ?string $countryCode;

    /**
     * The EORI number (without country code prefix).
     */
    #[Optional('eori_number')]
    public ?string $eoriNumber;

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
        ?string $companyAddress = null,
        ?string $companyName = null,
        ?string $countryCode = null,
        ?string $eoriNumber = null,
    ): self {
        $self = new self;

        null !== $companyAddress && $self['companyAddress'] = $companyAddress;
        null !== $companyName && $self['companyName'] = $companyName;
        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $eoriNumber && $self['eoriNumber'] = $eoriNumber;

        return $self;
    }

    public function withCompanyAddress(string $companyAddress): self
    {
        $self = clone $this;
        $self['companyAddress'] = $companyAddress;

        return $self;
    }

    public function withCompanyName(string $companyName): self
    {
        $self = clone $this;
        $self['companyName'] = $companyName;

        return $self;
    }

    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * The EORI number (without country code prefix).
     */
    public function withEoriNumber(string $eoriNumber): self
    {
        $self = clone $this;
        $self['eoriNumber'] = $eoriNumber;

        return $self;
    }
}
