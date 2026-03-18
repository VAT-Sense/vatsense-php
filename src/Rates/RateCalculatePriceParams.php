<?php

declare(strict_types=1);

namespace VatsenseVatsense\Rates;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Attributes\Required;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Concerns\SdkParams;
use VatsenseVatsense\Core\Contracts\BaseModel;
use VatsenseVatsense\Rates\RateCalculatePriceParams\TaxType;

/**
 * Combines the functionality of the "Find a tax rate" and "VAT price
 * calculation" endpoints to return the particular VAT price for an
 * applicable VAT rate. Requires both a location (country_code or ip_address)
 * and a price to calculate.
 *
 * @see VatsenseVatsense\Services\RatesService::calculatePrice()
 *
 * @phpstan-type RateCalculatePriceParamsShape = array{
 *   price: string,
 *   taxType: TaxType|value-of<TaxType>,
 *   countryCode?: string|null,
 *   eu?: bool|null,
 *   ipAddress?: string|null,
 *   provinceCode?: string|null,
 *   type?: string|null,
 * }
 */
final class RateCalculatePriceParams implements BaseModel
{
    /** @use SdkModel<RateCalculatePriceParamsShape> */
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
     * A 2-character ISO 3166-1 alpha-2 country code (e.g. "GB", "FR").
     */
    #[Optional]
    public ?string $countryCode;

    /**
     * Filter results by EU membership. Use 1 for EU countries only, 0 for non-EU only.
     */
    #[Optional]
    public ?bool $eu;

    /**
     * An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     */
    #[Optional]
    public ?string $ipAddress;

    /**
     * A 2-character province code (e.g. "NU", "NT"). If providing a province
     * code, you must also provide the relevant country_code.
     */
    #[Optional]
    public ?string $provinceCode;

    /**
     * The product type to find the applicable rate for. See the /rates/types
     * endpoint for a full list of valid values.
     */
    #[Optional]
    public ?string $type;

    /**
     * `new RateCalculatePriceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RateCalculatePriceParams::with(price: ..., taxType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RateCalculatePriceParams)->withPrice(...)->withTaxType(...)
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
        ?string $countryCode = null,
        ?bool $eu = null,
        ?string $ipAddress = null,
        ?string $provinceCode = null,
        ?string $type = null,
    ): self {
        $self = new self;

        $self['price'] = $price;
        $self['taxType'] = $taxType;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $eu && $self['eu'] = $eu;
        null !== $ipAddress && $self['ipAddress'] = $ipAddress;
        null !== $provinceCode && $self['provinceCode'] = $provinceCode;
        null !== $type && $self['type'] = $type;

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
     * A 2-character ISO 3166-1 alpha-2 country code (e.g. "GB", "FR").
     */
    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Filter results by EU membership. Use 1 for EU countries only, 0 for non-EU only.
     */
    public function withEu(bool $eu): self
    {
        $self = clone $this;
        $self['eu'] = $eu;

        return $self;
    }

    /**
     * An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     */
    public function withIPAddress(string $ipAddress): self
    {
        $self = clone $this;
        $self['ipAddress'] = $ipAddress;

        return $self;
    }

    /**
     * A 2-character province code (e.g. "NU", "NT"). If providing a province
     * code, you must also provide the relevant country_code.
     */
    public function withProvinceCode(string $provinceCode): self
    {
        $self = clone $this;
        $self['provinceCode'] = $provinceCode;

        return $self;
    }

    /**
     * The product type to find the applicable rate for. See the /rates/types
     * endpoint for a full list of valid values.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
