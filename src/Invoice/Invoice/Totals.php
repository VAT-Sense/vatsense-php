<?php

declare(strict_types=1);

namespace Vatsense\Invoice\Invoice;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type TotalsShape = array{
 *   discount?: float|null,
 *   subtotal?: float|null,
 *   total?: float|null,
 *   vat?: float|null,
 * }
 */
final class Totals implements BaseModel
{
    /** @use SdkModel<TotalsShape> */
    use SdkModel;

    /**
     * Total discount amount.
     */
    #[Optional]
    public ?float $discount;

    /**
     * Total before VAT.
     */
    #[Optional]
    public ?float $subtotal;

    /**
     * Grand total.
     */
    #[Optional]
    public ?float $total;

    /**
     * Total VAT amount.
     */
    #[Optional]
    public ?float $vat;

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
        ?float $discount = null,
        ?float $subtotal = null,
        ?float $total = null,
        ?float $vat = null,
    ): self {
        $self = new self;

        null !== $discount && $self['discount'] = $discount;
        null !== $subtotal && $self['subtotal'] = $subtotal;
        null !== $total && $self['total'] = $total;
        null !== $vat && $self['vat'] = $vat;

        return $self;
    }

    /**
     * Total discount amount.
     */
    public function withDiscount(float $discount): self
    {
        $self = clone $this;
        $self['discount'] = $discount;

        return $self;
    }

    /**
     * Total before VAT.
     */
    public function withSubtotal(float $subtotal): self
    {
        $self = clone $this;
        $self['subtotal'] = $subtotal;

        return $self;
    }

    /**
     * Grand total.
     */
    public function withTotal(float $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    /**
     * Total VAT amount.
     */
    public function withVat(float $vat): self
    {
        $self = clone $this;
        $self['vat'] = $vat;

        return $self;
    }
}
