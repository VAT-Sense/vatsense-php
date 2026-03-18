<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Invoice;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Attributes\Required;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Concerns\SdkParams;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;
use VatsenseVatsensePhp\Invoice\InvoiceCreateParams\TaxType;
use VatsenseVatsensePhp\Invoice\InvoiceCreateParams\Type;
use VatsenseVatsensePhp\Invoice\Item\InvoiceItemInput;

/**
 * Create a new VAT-compliant invoice. VAT Sense will automatically
 * calculate the totals based on the items provided.
 *
 * Not available with sandbox API keys.
 *
 * @see VatsenseVatsensePhp\Services\InvoiceService::create()
 *
 * @phpstan-import-type InvoiceBusinessInputShape from \VatsenseVatsensePhp\Invoice\InvoiceBusinessInput
 * @phpstan-import-type InvoiceItemInputShape from \VatsenseVatsensePhp\Invoice\Item\InvoiceItemInput
 * @phpstan-import-type InvoiceConversionInputShape from \VatsenseVatsensePhp\Invoice\InvoiceConversionInput
 * @phpstan-import-type InvoiceCustomerInputShape from \VatsenseVatsensePhp\Invoice\InvoiceCustomerInput
 *
 * @phpstan-type InvoiceCreateParamsShape = array{
 *   business: InvoiceBusinessInput|InvoiceBusinessInputShape,
 *   currencyCode: string,
 *   date: string,
 *   items: list<InvoiceItemInput|InvoiceItemInputShape>,
 *   taxPoint: string,
 *   conversion?: null|InvoiceConversionInput|InvoiceConversionInputShape,
 *   customer?: null|InvoiceCustomerInput|InvoiceCustomerInputShape,
 *   hasVat?: bool|null,
 *   invoiceNumber?: string|null,
 *   isCopy?: bool|null,
 *   isReverseCharge?: bool|null,
 *   notes?: string|null,
 *   padInvoiceNumber?: int|null,
 *   serial?: string|null,
 *   taxType?: null|TaxType|value-of<TaxType>,
 *   type?: null|Type|value-of<Type>,
 *   zeroRated?: bool|null,
 * }
 */
final class InvoiceCreateParams implements BaseModel
{
    /** @use SdkModel<InvoiceCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public InvoiceBusinessInput $business;

    /**
     * The 3-character currency code the invoice is billed in.
     */
    #[Required('currency_code')]
    public string $currencyCode;

    /**
     * The date the invoice was issued (YYYY-MM-DD or YYYY-MM-DD HH:MM:SS).
     */
    #[Required]
    public string $date;

    /** @var list<InvoiceItemInput> $items */
    #[Required(list: InvoiceItemInput::class)]
    public array $items;

    /**
     * The tax point or "time of supply" (YYYY-MM-DD or YYYY-MM-DD HH:MM:SS).
     */
    #[Required('tax_point')]
    public string $taxPoint;

    #[Optional]
    public ?InvoiceConversionInput $conversion;

    #[Optional]
    public ?InvoiceCustomerInput $customer;

    /**
     * Whether the invoice is subject to VAT.
     */
    #[Optional('has_vat')]
    public ?bool $hasVat;

    /**
     * A unique invoice number. If not provided, defaults to an auto-incremented number.
     */
    #[Optional('invoice_number')]
    public ?string $invoiceNumber;

    /**
     * Whether the invoice is a copy of a primary invoice.
     */
    #[Optional('is_copy')]
    public ?bool $isCopy;

    /**
     * Whether the invoice is zero-rated due to reverse charge.
     */
    #[Optional('is_reverse_charge')]
    public ?bool $isReverseCharge;

    /**
     * Any additional notes for the invoice.
     */
    #[Optional]
    public ?string $notes;

    /**
     * Pad the auto-generated invoice number with leading zeros to this length.
     */
    #[Optional('pad_invoice_number')]
    public ?int $padInvoiceNumber;

    /**
     * A serial prepended to the auto-generated invoice number. Each unique serial has its own auto-increment range.
     */
    #[Optional]
    public ?string $serial;

    /**
     * Whether item prices include or exclude VAT.
     *
     * @var value-of<TaxType>|null $taxType
     */
    #[Optional('tax_type', enum: TaxType::class)]
    public ?string $taxType;

    /**
     * The type of invoice.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Whether the invoice has been zero-rated.
     */
    #[Optional('zero_rated')]
    public ?bool $zeroRated;

    /**
     * `new InvoiceCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceCreateParams::with(
     *   business: ..., currencyCode: ..., date: ..., items: ..., taxPoint: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceCreateParams)
     *   ->withBusiness(...)
     *   ->withCurrencyCode(...)
     *   ->withDate(...)
     *   ->withItems(...)
     *   ->withTaxPoint(...)
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
     *
     * @param InvoiceBusinessInput|InvoiceBusinessInputShape $business
     * @param list<InvoiceItemInput|InvoiceItemInputShape> $items
     * @param InvoiceConversionInput|InvoiceConversionInputShape|null $conversion
     * @param InvoiceCustomerInput|InvoiceCustomerInputShape|null $customer
     * @param TaxType|value-of<TaxType>|null $taxType
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        InvoiceBusinessInput|array $business,
        string $currencyCode,
        string $date,
        array $items,
        string $taxPoint,
        InvoiceConversionInput|array|null $conversion = null,
        InvoiceCustomerInput|array|null $customer = null,
        ?bool $hasVat = null,
        ?string $invoiceNumber = null,
        ?bool $isCopy = null,
        ?bool $isReverseCharge = null,
        ?string $notes = null,
        ?int $padInvoiceNumber = null,
        ?string $serial = null,
        TaxType|string|null $taxType = null,
        Type|string|null $type = null,
        ?bool $zeroRated = null,
    ): self {
        $self = new self;

        $self['business'] = $business;
        $self['currencyCode'] = $currencyCode;
        $self['date'] = $date;
        $self['items'] = $items;
        $self['taxPoint'] = $taxPoint;

        null !== $conversion && $self['conversion'] = $conversion;
        null !== $customer && $self['customer'] = $customer;
        null !== $hasVat && $self['hasVat'] = $hasVat;
        null !== $invoiceNumber && $self['invoiceNumber'] = $invoiceNumber;
        null !== $isCopy && $self['isCopy'] = $isCopy;
        null !== $isReverseCharge && $self['isReverseCharge'] = $isReverseCharge;
        null !== $notes && $self['notes'] = $notes;
        null !== $padInvoiceNumber && $self['padInvoiceNumber'] = $padInvoiceNumber;
        null !== $serial && $self['serial'] = $serial;
        null !== $taxType && $self['taxType'] = $taxType;
        null !== $type && $self['type'] = $type;
        null !== $zeroRated && $self['zeroRated'] = $zeroRated;

        return $self;
    }

    /**
     * @param InvoiceBusinessInput|InvoiceBusinessInputShape $business
     */
    public function withBusiness(InvoiceBusinessInput|array $business): self
    {
        $self = clone $this;
        $self['business'] = $business;

        return $self;
    }

    /**
     * The 3-character currency code the invoice is billed in.
     */
    public function withCurrencyCode(string $currencyCode): self
    {
        $self = clone $this;
        $self['currencyCode'] = $currencyCode;

        return $self;
    }

    /**
     * The date the invoice was issued (YYYY-MM-DD or YYYY-MM-DD HH:MM:SS).
     */
    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * @param list<InvoiceItemInput|InvoiceItemInputShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * The tax point or "time of supply" (YYYY-MM-DD or YYYY-MM-DD HH:MM:SS).
     */
    public function withTaxPoint(string $taxPoint): self
    {
        $self = clone $this;
        $self['taxPoint'] = $taxPoint;

        return $self;
    }

    /**
     * @param InvoiceConversionInput|InvoiceConversionInputShape $conversion
     */
    public function withConversion(
        InvoiceConversionInput|array $conversion
    ): self {
        $self = clone $this;
        $self['conversion'] = $conversion;

        return $self;
    }

    /**
     * @param InvoiceCustomerInput|InvoiceCustomerInputShape $customer
     */
    public function withCustomer(InvoiceCustomerInput|array $customer): self
    {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    /**
     * Whether the invoice is subject to VAT.
     */
    public function withHasVat(bool $hasVat): self
    {
        $self = clone $this;
        $self['hasVat'] = $hasVat;

        return $self;
    }

    /**
     * A unique invoice number. If not provided, defaults to an auto-incremented number.
     */
    public function withInvoiceNumber(string $invoiceNumber): self
    {
        $self = clone $this;
        $self['invoiceNumber'] = $invoiceNumber;

        return $self;
    }

    /**
     * Whether the invoice is a copy of a primary invoice.
     */
    public function withIsCopy(bool $isCopy): self
    {
        $self = clone $this;
        $self['isCopy'] = $isCopy;

        return $self;
    }

    /**
     * Whether the invoice is zero-rated due to reverse charge.
     */
    public function withIsReverseCharge(bool $isReverseCharge): self
    {
        $self = clone $this;
        $self['isReverseCharge'] = $isReverseCharge;

        return $self;
    }

    /**
     * Any additional notes for the invoice.
     */
    public function withNotes(string $notes): self
    {
        $self = clone $this;
        $self['notes'] = $notes;

        return $self;
    }

    /**
     * Pad the auto-generated invoice number with leading zeros to this length.
     */
    public function withPadInvoiceNumber(int $padInvoiceNumber): self
    {
        $self = clone $this;
        $self['padInvoiceNumber'] = $padInvoiceNumber;

        return $self;
    }

    /**
     * A serial prepended to the auto-generated invoice number. Each unique serial has its own auto-increment range.
     */
    public function withSerial(string $serial): self
    {
        $self = clone $this;
        $self['serial'] = $serial;

        return $self;
    }

    /**
     * Whether item prices include or exclude VAT.
     *
     * @param TaxType|value-of<TaxType> $taxType
     */
    public function withTaxType(TaxType|string $taxType): self
    {
        $self = clone $this;
        $self['taxType'] = $taxType;

        return $self;
    }

    /**
     * The type of invoice.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Whether the invoice has been zero-rated.
     */
    public function withZeroRated(bool $zeroRated): self
    {
        $self = clone $this;
        $self['zeroRated'] = $zeroRated;

        return $self;
    }
}
