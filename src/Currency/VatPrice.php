<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Currency;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;
use VatsenseVatsensePhp\Currency\VatPrice\Object_;
use VatsenseVatsensePhp\Currency\VatPrice\TaxType;

/**
 * @phpstan-type VatPriceShape = array{
 *   object?: null|Object_|value-of<Object_>,
 *   price?: float|null,
 *   priceExclVat?: float|null,
 *   priceInclVat?: float|null,
 *   taxType?: null|TaxType|value-of<TaxType>,
 *   vat?: float|null,
 *   vatRate?: float|null,
 * }
 */
final class VatPrice implements BaseModel
{
    /** @use SdkModel<VatPriceShape> */
    use SdkModel;

    /** @var value-of<Object_>|null $object */
    #[Optional(enum: Object_::class)]
    public ?string $object;

    /**
     * The price provided.
     */
    #[Optional]
    public ?float $price;

    /**
     * The calculated price exclusive of VAT.
     */
    #[Optional('price_excl_vat')]
    public ?float $priceExclVat;

    /**
     * The calculated price inclusive of VAT.
     */
    #[Optional('price_incl_vat')]
    public ?float $priceInclVat;

    /**
     * Whether the price is inclusive or exclusive of VAT.
     *
     * @var value-of<TaxType>|null $taxType
     */
    #[Optional('tax_type', enum: TaxType::class)]
    public ?string $taxType;

    /**
     * The total VAT amount.
     */
    #[Optional]
    public ?float $vat;

    /**
     * The VAT rate percentage.
     */
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
     * @param TaxType|value-of<TaxType>|null $taxType
     */
    public static function with(
        Object_|string|null $object = null,
        ?float $price = null,
        ?float $priceExclVat = null,
        ?float $priceInclVat = null,
        TaxType|string|null $taxType = null,
        ?float $vat = null,
        ?float $vatRate = null,
    ): self {
        $self = new self;

        null !== $object && $self['object'] = $object;
        null !== $price && $self['price'] = $price;
        null !== $priceExclVat && $self['priceExclVat'] = $priceExclVat;
        null !== $priceInclVat && $self['priceInclVat'] = $priceInclVat;
        null !== $taxType && $self['taxType'] = $taxType;
        null !== $vat && $self['vat'] = $vat;
        null !== $vatRate && $self['vatRate'] = $vatRate;

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

    /**
     * The price provided.
     */
    public function withPrice(float $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * The calculated price exclusive of VAT.
     */
    public function withPriceExclVat(float $priceExclVat): self
    {
        $self = clone $this;
        $self['priceExclVat'] = $priceExclVat;

        return $self;
    }

    /**
     * The calculated price inclusive of VAT.
     */
    public function withPriceInclVat(float $priceInclVat): self
    {
        $self = clone $this;
        $self['priceInclVat'] = $priceInclVat;

        return $self;
    }

    /**
     * Whether the price is inclusive or exclusive of VAT.
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
     * The total VAT amount.
     */
    public function withVat(float $vat): self
    {
        $self = clone $this;
        $self['vat'] = $vat;

        return $self;
    }

    /**
     * The VAT rate percentage.
     */
    public function withVatRate(float $vatRate): self
    {
        $self = clone $this;
        $self['vatRate'] = $vatRate;

        return $self;
    }
}
