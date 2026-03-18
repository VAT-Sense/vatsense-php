<?php

declare(strict_types=1);

namespace VatsenseVatsense\Currency;

use VatsenseVatsense\Core\Attributes\Required;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Concerns\SdkParams;
use VatsenseVatsense\Core\Contracts\BaseModel;
use VatsenseVatsense\Currency\CurrencyCalculateVatPriceParams\TaxType;

/**
 * Calculate the inclusive and exclusive VAT price on a given amount and
 * VAT rate. This is a standalone calculation that does not look up rates
 * by country.
 *
 * @see VatsenseVatsense\Services\CurrencyService::calculateVatPrice()
 *
 * @phpstan-type CurrencyCalculateVatPriceParamsShape = array{
 *   price: string, taxType: TaxType|value-of<TaxType>, vatRate: float
 * }
 */
final class CurrencyCalculateVatPriceParams implements BaseModel
{
    /** @use SdkModel<CurrencyCalculateVatPriceParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The price to calculate on. Must be a string with exactly 2 decimal places (e.g. "30.00", "59.95").
     */
    #[Required]
    public string $price;

    /**
     * Whether the provided price is inclusive or exclusive of VAT.
     *
     * @var value-of<TaxType> $taxType
     */
    #[Required(enum: TaxType::class)]
    public string $taxType;

    /**
     * A percentage VAT rate to use for the calculation.
     */
    #[Required]
    public float $vatRate;

    /**
     * `new CurrencyCalculateVatPriceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CurrencyCalculateVatPriceParams::with(price: ..., taxType: ..., vatRate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CurrencyCalculateVatPriceParams)
     *   ->withPrice(...)
     *   ->withTaxType(...)
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
     *
     * @param TaxType|value-of<TaxType> $taxType
     */
    public static function with(
        string $price,
        TaxType|string $taxType,
        float $vatRate
    ): self {
        $self = new self;

        $self['price'] = $price;
        $self['taxType'] = $taxType;
        $self['vatRate'] = $vatRate;

        return $self;
    }

    /**
     * The price to calculate on. Must be a string with exactly 2 decimal places (e.g. "30.00", "59.95").
     */
    public function withPrice(string $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Whether the provided price is inclusive or exclusive of VAT.
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
     * A percentage VAT rate to use for the calculation.
     */
    public function withVatRate(float $vatRate): self
    {
        $self = clone $this;
        $self['vatRate'] = $vatRate;

        return $self;
    }
}
