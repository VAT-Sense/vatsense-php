<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Rates;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Concerns\SdkParams;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;

/**
 * A handy endpoint for finding a rate that applies to a particular country
 * and optional product type, based on country code or IP address.
 *
 * If no type is provided, or no specific rate is applied to the given type,
 * then the standard rate will be returned if the country is subject to tax.
 *
 * If the country is not subject to VAT/GST then an error response will be
 * returned, indicating no tax applies.
 *
 * @see VatsenseVatsensePhp\Services\RatesService::find()
 *
 * @phpstan-type RateFindParamsShape = array{
 *   countryCode?: string|null,
 *   eu?: bool|null,
 *   ipAddress?: string|null,
 *   period?: \DateTimeInterface|null,
 *   provinceCode?: string|null,
 *   type?: string|null,
 * }
 */
final class RateFindParams implements BaseModel
{
    /** @use SdkModel<RateFindParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * A historical date to retrieve rates for (format "YYYY-MM-DD HH:MM:SS"). Must be a past date.
     */
    #[Optional]
    public ?\DateTimeInterface $period;

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
        ?string $countryCode = null,
        ?bool $eu = null,
        ?string $ipAddress = null,
        ?\DateTimeInterface $period = null,
        ?string $provinceCode = null,
        ?string $type = null,
    ): self {
        $self = new self;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $eu && $self['eu'] = $eu;
        null !== $ipAddress && $self['ipAddress'] = $ipAddress;
        null !== $period && $self['period'] = $period;
        null !== $provinceCode && $self['provinceCode'] = $provinceCode;
        null !== $type && $self['type'] = $type;

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
     * A historical date to retrieve rates for (format "YYYY-MM-DD HH:MM:SS"). Must be a past date.
     */
    public function withPeriod(\DateTimeInterface $period): self
    {
        $self = clone $this;
        $self['period'] = $period;

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
