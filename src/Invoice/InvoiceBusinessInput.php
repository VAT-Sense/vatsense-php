<?php

declare(strict_types=1);

namespace VatsenseVatsense\Invoice;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Attributes\Required;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvoiceBusinessInputShape = array{
 *   address: string,
 *   name: string,
 *   vatNumber: string,
 *   bankAccount?: string|null,
 *   companyNumber?: string|null,
 *   email?: string|null,
 *   logo?: string|null,
 *   phone?: string|null,
 *   website?: string|null,
 * }
 */
final class InvoiceBusinessInput implements BaseModel
{
    /** @use SdkModel<InvoiceBusinessInputShape> */
    use SdkModel;

    /**
     * Your business trading address.
     */
    #[Required]
    public string $address;

    /**
     * Your business trading name.
     */
    #[Required]
    public string $name;

    /**
     * Your business VAT number.
     */
    #[Required('vat_number')]
    public string $vatNumber;

    #[Optional('bank_account')]
    public ?string $bankAccount;

    /**
     * Your business company number.
     */
    #[Optional('company_number')]
    public ?string $companyNumber;

    #[Optional]
    public ?string $email;

    /**
     * URL to your company logo (HTTPS only, .svg/.jpg/.png). Recommended 240px by 60px.
     */
    #[Optional]
    public ?string $logo;

    #[Optional]
    public ?string $phone;

    #[Optional]
    public ?string $website;

    /**
     * `new InvoiceBusinessInput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceBusinessInput::with(address: ..., name: ..., vatNumber: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceBusinessInput)->withAddress(...)->withName(...)->withVatNumber(...)
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
        string $address,
        string $name,
        string $vatNumber,
        ?string $bankAccount = null,
        ?string $companyNumber = null,
        ?string $email = null,
        ?string $logo = null,
        ?string $phone = null,
        ?string $website = null,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['name'] = $name;
        $self['vatNumber'] = $vatNumber;

        null !== $bankAccount && $self['bankAccount'] = $bankAccount;
        null !== $companyNumber && $self['companyNumber'] = $companyNumber;
        null !== $email && $self['email'] = $email;
        null !== $logo && $self['logo'] = $logo;
        null !== $phone && $self['phone'] = $phone;
        null !== $website && $self['website'] = $website;

        return $self;
    }

    /**
     * Your business trading address.
     */
    public function withAddress(string $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * Your business trading name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Your business VAT number.
     */
    public function withVatNumber(string $vatNumber): self
    {
        $self = clone $this;
        $self['vatNumber'] = $vatNumber;

        return $self;
    }

    public function withBankAccount(string $bankAccount): self
    {
        $self = clone $this;
        $self['bankAccount'] = $bankAccount;

        return $self;
    }

    /**
     * Your business company number.
     */
    public function withCompanyNumber(string $companyNumber): self
    {
        $self = clone $this;
        $self['companyNumber'] = $companyNumber;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * URL to your company logo (HTTPS only, .svg/.jpg/.png). Recommended 240px by 60px.
     */
    public function withLogo(string $logo): self
    {
        $self = clone $this;
        $self['logo'] = $logo;

        return $self;
    }

    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }

    public function withWebsite(string $website): self
    {
        $self = clone $this;
        $self['website'] = $website;

        return $self;
    }
}
