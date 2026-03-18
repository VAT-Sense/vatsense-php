<?php

declare(strict_types=1);

namespace VatsenseVatsense\Invoice\Invoice;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type BusinessShape = array{
 *   address?: string|null,
 *   companyNumber?: string|null,
 *   logo?: string|null,
 *   name?: string|null,
 *   vatNumber?: string|null,
 * }
 */
final class Business implements BaseModel
{
    /** @use SdkModel<BusinessShape> */
    use SdkModel;

    #[Optional]
    public ?string $address;

    #[Optional('company_number')]
    public ?string $companyNumber;

    #[Optional(nullable: true)]
    public ?string $logo;

    #[Optional]
    public ?string $name;

    #[Optional('vat_number')]
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
        ?string $address = null,
        ?string $companyNumber = null,
        ?string $logo = null,
        ?string $name = null,
        ?string $vatNumber = null,
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $companyNumber && $self['companyNumber'] = $companyNumber;
        null !== $logo && $self['logo'] = $logo;
        null !== $name && $self['name'] = $name;
        null !== $vatNumber && $self['vatNumber'] = $vatNumber;

        return $self;
    }

    public function withAddress(string $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    public function withCompanyNumber(string $companyNumber): self
    {
        $self = clone $this;
        $self['companyNumber'] = $companyNumber;

        return $self;
    }

    public function withLogo(?string $logo): self
    {
        $self = clone $this;
        $self['logo'] = $logo;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withVatNumber(string $vatNumber): self
    {
        $self = clone $this;
        $self['vatNumber'] = $vatNumber;

        return $self;
    }
}
