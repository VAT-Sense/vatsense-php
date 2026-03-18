<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Invoice;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Attributes\Required;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvoiceCustomerInputShape = array{
 *   name: string,
 *   address?: string|null,
 *   companyNumber?: string|null,
 *   countryCode?: string|null,
 *   email?: string|null,
 *   logo?: string|null,
 *   vatNumber?: string|null,
 * }
 */
final class InvoiceCustomerInput implements BaseModel
{
    /** @use SdkModel<InvoiceCustomerInputShape> */
    use SdkModel;

    /**
     * The customer's trading name.
     */
    #[Required]
    public string $name;

    #[Optional]
    public ?string $address;

    #[Optional('company_number')]
    public ?string $companyNumber;

    #[Optional('country_code')]
    public ?string $countryCode;

    #[Optional]
    public ?string $email;

    /**
     * URL to the customer logo (HTTPS only, .jpg/.png).
     */
    #[Optional]
    public ?string $logo;

    #[Optional('vat_number')]
    public ?string $vatNumber;

    /**
     * `new InvoiceCustomerInput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceCustomerInput::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceCustomerInput)->withName(...)
     * ```
     */
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
        string $name,
        ?string $address = null,
        ?string $companyNumber = null,
        ?string $countryCode = null,
        ?string $email = null,
        ?string $logo = null,
        ?string $vatNumber = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $address && $self['address'] = $address;
        null !== $companyNumber && $self['companyNumber'] = $companyNumber;
        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $email && $self['email'] = $email;
        null !== $logo && $self['logo'] = $logo;
        null !== $vatNumber && $self['vatNumber'] = $vatNumber;

        return $self;
    }

    /**
     * The customer's trading name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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

    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * URL to the customer logo (HTTPS only, .jpg/.png).
     */
    public function withLogo(string $logo): self
    {
        $self = clone $this;
        $self['logo'] = $logo;

        return $self;
    }

    public function withVatNumber(string $vatNumber): self
    {
        $self = clone $this;
        $self['vatNumber'] = $vatNumber;

        return $self;
    }
}
