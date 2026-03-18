<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Invoice\Item;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;
use VatsenseVatsensePhp\Invoice\Item\InvoiceItem\Object_;

/**
 * @phpstan-type InvoiceItemShape = array{
 *   id?: string|null,
 *   discountRate?: float|null,
 *   item?: string|null,
 *   object?: null|Object_|value-of<Object_>,
 *   priceEach?: float|null,
 *   priceTotal?: float|null,
 *   quantity?: float|null,
 *   vatRate?: float|null,
 * }
 */
final class InvoiceItem implements BaseModel
{
    /** @use SdkModel<InvoiceItemShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional('discount_rate', nullable: true)]
    public ?float $discountRate;

    #[Optional]
    public ?string $item;

    /** @var value-of<Object_>|null $object */
    #[Optional(enum: Object_::class)]
    public ?string $object;

    #[Optional('price_each')]
    public ?float $priceEach;

    #[Optional('price_total')]
    public ?float $priceTotal;

    #[Optional]
    public ?float $quantity;

    #[Optional('vat_rate')]
    public ?float $vatRate;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Object_|value-of<Object_>|null $object
     */
    public static function with(
        ?string $id = null,
        ?float $discountRate = null,
        ?string $item = null,
        Object_|string|null $object = null,
        ?float $priceEach = null,
        ?float $priceTotal = null,
        ?float $quantity = null,
        ?float $vatRate = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $discountRate && $self['discountRate'] = $discountRate;
        null !== $item && $self['item'] = $item;
        null !== $object && $self['object'] = $object;
        null !== $priceEach && $self['priceEach'] = $priceEach;
        null !== $priceTotal && $self['priceTotal'] = $priceTotal;
        null !== $quantity && $self['quantity'] = $quantity;
        null !== $vatRate && $self['vatRate'] = $vatRate;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withDiscountRate(?float $discountRate): self
    {
        $self = clone $this;
        $self['discountRate'] = $discountRate;

        return $self;
    }

    public function withItem(string $item): self
    {
        $self = clone $this;
        $self['item'] = $item;

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

    public function withPriceEach(float $priceEach): self
    {
        $self = clone $this;
        $self['priceEach'] = $priceEach;

        return $self;
    }

    public function withPriceTotal(float $priceTotal): self
    {
        $self = clone $this;
        $self['priceTotal'] = $priceTotal;

        return $self;
    }

    public function withQuantity(float $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    public function withVatRate(float $vatRate): self
    {
        $self = clone $this;
        $self['vatRate'] = $vatRate;

        return $self;
    }
}
