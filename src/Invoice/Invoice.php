<?php

declare(strict_types=1);

namespace VatsenseVatsense\Invoice;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;
use VatsenseVatsense\Invoice\Invoice\Business;
use VatsenseVatsense\Invoice\Invoice\Customer;
use VatsenseVatsense\Invoice\Invoice\Object_;
use VatsenseVatsense\Invoice\Invoice\TaxType;
use VatsenseVatsense\Invoice\Invoice\Totals;
use VatsenseVatsense\Invoice\Invoice\Type;
use VatsenseVatsense\Invoice\Item\InvoiceItem;

/**
 * @phpstan-import-type BusinessShape from \VatsenseVatsense\Invoice\Invoice\Business
 * @phpstan-import-type InvoiceConversionInputShape from \VatsenseVatsense\Invoice\InvoiceConversionInput
 * @phpstan-import-type CustomerShape from \VatsenseVatsense\Invoice\Invoice\Customer
 * @phpstan-import-type InvoiceItemShape from \VatsenseVatsense\Invoice\Item\InvoiceItem
 * @phpstan-import-type TotalsShape from \VatsenseVatsense\Invoice\Invoice\Totals
 *
 * @phpstan-type InvoiceShape = array{
 *   id?: string|null,
 *   business?: null|Business|BusinessShape,
 *   conversion?: null|InvoiceConversionInput|InvoiceConversionInputShape,
 *   created?: \DateTimeInterface|null,
 *   currencyCode?: string|null,
 *   customer?: null|Customer|CustomerShape,
 *   date?: string|null,
 *   hasVat?: bool|null,
 *   invoiceNumber?: string|null,
 *   invoiceURL?: string|null,
 *   isCopy?: bool|null,
 *   isReverseCharge?: bool|null,
 *   items?: list<InvoiceItem|InvoiceItemShape>|null,
 *   notes?: string|null,
 *   numItems?: int|null,
 *   object?: null|Object_|value-of<Object_>,
 *   taxPoint?: string|null,
 *   taxType?: null|TaxType|value-of<TaxType>,
 *   totals?: null|Totals|TotalsShape,
 *   type?: null|Type|value-of<Type>,
 *   updated?: \DateTimeInterface|null,
 *   zeroRated?: bool|null,
 * }
 */
final class Invoice implements BaseModel
{
    /** @use SdkModel<InvoiceShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?Business $business;

    #[Optional(nullable: true)]
    public ?InvoiceConversionInput $conversion;

    #[Optional]
    public ?\DateTimeInterface $created;

    #[Optional('currency_code')]
    public ?string $currencyCode;

    #[Optional(nullable: true)]
    public ?Customer $customer;

    #[Optional]
    public ?string $date;

    #[Optional('has_vat')]
    public ?bool $hasVat;

    #[Optional('invoice_number')]
    public ?string $invoiceNumber;

    /**
     * Unique URL to view the invoice. Append "/pdf" to download a PDF copy.
     */
    #[Optional('invoice_url')]
    public ?string $invoiceURL;

    #[Optional('is_copy')]
    public ?bool $isCopy;

    #[Optional('is_reverse_charge')]
    public ?bool $isReverseCharge;

    /** @var list<InvoiceItem>|null $items */
    #[Optional(list: InvoiceItem::class)]
    public ?array $items;

    #[Optional(nullable: true)]
    public ?string $notes;

    #[Optional('num_items')]
    public ?int $numItems;

    /** @var value-of<Object_>|null $object */
    #[Optional(enum: Object_::class)]
    public ?string $object;

    #[Optional('tax_point')]
    public ?string $taxPoint;

    /** @var value-of<TaxType>|null $taxType */
    #[Optional('tax_type', enum: TaxType::class)]
    public ?string $taxType;

    #[Optional]
    public ?Totals $totals;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    #[Optional]
    public ?\DateTimeInterface $updated;

    #[Optional('zero_rated')]
    public ?bool $zeroRated;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Business|BusinessShape|null $business
     * @param InvoiceConversionInput|InvoiceConversionInputShape|null $conversion
     * @param Customer|CustomerShape|null $customer
     * @param list<InvoiceItem|InvoiceItemShape>|null $items
     * @param Object_|value-of<Object_>|null $object
     * @param TaxType|value-of<TaxType>|null $taxType
     * @param Totals|TotalsShape|null $totals
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?string $id = null,
        Business|array|null $business = null,
        InvoiceConversionInput|array|null $conversion = null,
        ?\DateTimeInterface $created = null,
        ?string $currencyCode = null,
        Customer|array|null $customer = null,
        ?string $date = null,
        ?bool $hasVat = null,
        ?string $invoiceNumber = null,
        ?string $invoiceURL = null,
        ?bool $isCopy = null,
        ?bool $isReverseCharge = null,
        ?array $items = null,
        ?string $notes = null,
        ?int $numItems = null,
        Object_|string|null $object = null,
        ?string $taxPoint = null,
        TaxType|string|null $taxType = null,
        Totals|array|null $totals = null,
        Type|string|null $type = null,
        ?\DateTimeInterface $updated = null,
        ?bool $zeroRated = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $business && $self['business'] = $business;
        null !== $conversion && $self['conversion'] = $conversion;
        null !== $created && $self['created'] = $created;
        null !== $currencyCode && $self['currencyCode'] = $currencyCode;
        null !== $customer && $self['customer'] = $customer;
        null !== $date && $self['date'] = $date;
        null !== $hasVat && $self['hasVat'] = $hasVat;
        null !== $invoiceNumber && $self['invoiceNumber'] = $invoiceNumber;
        null !== $invoiceURL && $self['invoiceURL'] = $invoiceURL;
        null !== $isCopy && $self['isCopy'] = $isCopy;
        null !== $isReverseCharge && $self['isReverseCharge'] = $isReverseCharge;
        null !== $items && $self['items'] = $items;
        null !== $notes && $self['notes'] = $notes;
        null !== $numItems && $self['numItems'] = $numItems;
        null !== $object && $self['object'] = $object;
        null !== $taxPoint && $self['taxPoint'] = $taxPoint;
        null !== $taxType && $self['taxType'] = $taxType;
        null !== $totals && $self['totals'] = $totals;
        null !== $type && $self['type'] = $type;
        null !== $updated && $self['updated'] = $updated;
        null !== $zeroRated && $self['zeroRated'] = $zeroRated;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param Business|BusinessShape $business
     */
    public function withBusiness(Business|array $business): self
    {
        $self = clone $this;
        $self['business'] = $business;

        return $self;
    }

    /**
     * @param InvoiceConversionInput|InvoiceConversionInputShape|null $conversion
     */
    public function withConversion(
        InvoiceConversionInput|array|null $conversion
    ): self {
        $self = clone $this;
        $self['conversion'] = $conversion;

        return $self;
    }

    public function withCreated(\DateTimeInterface $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    public function withCurrencyCode(string $currencyCode): self
    {
        $self = clone $this;
        $self['currencyCode'] = $currencyCode;

        return $self;
    }

    /**
     * @param Customer|CustomerShape|null $customer
     */
    public function withCustomer(Customer|array|null $customer): self
    {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    public function withHasVat(bool $hasVat): self
    {
        $self = clone $this;
        $self['hasVat'] = $hasVat;

        return $self;
    }

    public function withInvoiceNumber(string $invoiceNumber): self
    {
        $self = clone $this;
        $self['invoiceNumber'] = $invoiceNumber;

        return $self;
    }

    /**
     * Unique URL to view the invoice. Append "/pdf" to download a PDF copy.
     */
    public function withInvoiceURL(string $invoiceURL): self
    {
        $self = clone $this;
        $self['invoiceURL'] = $invoiceURL;

        return $self;
    }

    public function withIsCopy(bool $isCopy): self
    {
        $self = clone $this;
        $self['isCopy'] = $isCopy;

        return $self;
    }

    public function withIsReverseCharge(bool $isReverseCharge): self
    {
        $self = clone $this;
        $self['isReverseCharge'] = $isReverseCharge;

        return $self;
    }

    /**
     * @param list<InvoiceItem|InvoiceItemShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    public function withNotes(?string $notes): self
    {
        $self = clone $this;
        $self['notes'] = $notes;

        return $self;
    }

    public function withNumItems(int $numItems): self
    {
        $self = clone $this;
        $self['numItems'] = $numItems;

        return $self;
    }

    /**
     * @param Object_|value-of<Object_> $object
     */
    public function withObject(Object_|string $object): self
    {
        $self = clone $this;
        $self['object'] = $object;

        return $self;
    }

    public function withTaxPoint(string $taxPoint): self
    {
        $self = clone $this;
        $self['taxPoint'] = $taxPoint;

        return $self;
    }

    /**
     * @param TaxType|value-of<TaxType> $taxType
     */
    public function withTaxType(TaxType|string $taxType): self
    {
        $self = clone $this;
        $self['taxType'] = $taxType;

        return $self;
    }

    /**
     * @param Totals|TotalsShape $totals
     */
    public function withTotals(Totals|array $totals): self
    {
        $self = clone $this;
        $self['totals'] = $totals;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withUpdated(\DateTimeInterface $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }

    public function withZeroRated(bool $zeroRated): self
    {
        $self = clone $this;
        $self['zeroRated'] = $zeroRated;

        return $self;
    }
}
