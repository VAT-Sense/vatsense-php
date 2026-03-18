<?php

declare(strict_types=1);

namespace Vatsense\Invoice\Item;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Concerns\SdkParams;
use Vatsense\Core\Contracts\BaseModel;

/**
 * Update a specific line item on an invoice.
 *
 * @see Vatsense\Services\Invoice\ItemService::update()
 *
 * @phpstan-type ItemUpdateParamsShape = array{
 *   invoiceID: string,
 *   item: string,
 *   priceEach: float,
 *   quantity: float,
 *   vatRate: float,
 *   discountRate?: float|null,
 * }
 */
final class ItemUpdateParams implements BaseModel
{
    /** @use SdkModel<ItemUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $invoiceID;

    /**
     * The description of the line item.
     */
    #[Required]
    public string $item;

    /**
     * The price per item. Must be a decimal with 2 decimal places.
     */
    #[Required('price_each')]
    public float $priceEach;

    /**
     * The quantity of the item.
     */
    #[Required]
    public float $quantity;

    /**
     * A percentage VAT rate for this item.
     */
    #[Required('vat_rate')]
    public float $vatRate;

    /**
     * A percentage discount to apply to the price.
     */
    #[Optional('discount_rate')]
    public ?float $discountRate;

    /**
     * `new ItemUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemUpdateParams::with(
     *   invoiceID: ..., item: ..., priceEach: ..., quantity: ..., vatRate: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ItemUpdateParams)
     *   ->withInvoiceID(...)
     *   ->withItem(...)
     *   ->withPriceEach(...)
     *   ->withQuantity(...)
     *   ->withVatRate(...)
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
        string $invoiceID,
        string $item,
        float $priceEach,
        float $quantity,
        float $vatRate,
        ?float $discountRate = null,
    ): self {
        $self = new self;

        $self['invoiceID'] = $invoiceID;
        $self['item'] = $item;
        $self['priceEach'] = $priceEach;
        $self['quantity'] = $quantity;
        $self['vatRate'] = $vatRate;

        null !== $discountRate && $self['discountRate'] = $discountRate;

        return $self;
    }

    public function withInvoiceID(string $invoiceID): self
    {
        $self = clone $this;
        $self['invoiceID'] = $invoiceID;

        return $self;
    }

    /**
     * The description of the line item.
     */
    public function withItem(string $item): self
    {
        $self = clone $this;
        $self['item'] = $item;

        return $self;
    }

    /**
     * The price per item. Must be a decimal with 2 decimal places.
     */
    public function withPriceEach(float $priceEach): self
    {
        $self = clone $this;
        $self['priceEach'] = $priceEach;

        return $self;
    }

    /**
     * The quantity of the item.
     */
    public function withQuantity(float $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * A percentage VAT rate for this item.
     */
    public function withVatRate(float $vatRate): self
    {
        $self = clone $this;
        $self['vatRate'] = $vatRate;

        return $self;
    }

    /**
     * A percentage discount to apply to the price.
     */
    public function withDiscountRate(float $discountRate): self
    {
        $self = clone $this;
        $self['discountRate'] = $discountRate;

        return $self;
    }
}
