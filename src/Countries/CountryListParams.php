<?php

declare(strict_types=1);

namespace VatsenseVatsense\Countries;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Concerns\SdkParams;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * Returns a list of all countries, including whether they are subject to
 * VAT/GST and whether they are subject to EU VAT. Each country is returned
 * as a country object.
 *
 * You can optionally filter by country code or IP address.
 *
 * @see VatsenseVatsense\Services\CountriesService::list()
 *
 * @phpstan-type CountryListParamsShape = array{
 *   countryCode?: string|null, ipAddress?: string|null
 * }
 */
final class CountryListParams implements BaseModel
{
    /** @use SdkModel<CountryListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A 2-character ISO 3166-1 alpha-2 country code (e.g. "GB", "FR").
     */
    #[Optional]
    public ?string $countryCode;

    /**
     * An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     */
    #[Optional]
    public ?string $ipAddress;

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
        ?string $ipAddress = null
    ): self {
        $self = new self;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $ipAddress && $self['ipAddress'] = $ipAddress;

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
     * An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     */
    public function withIPAddress(string $ipAddress): self
    {
        $self = clone $this;
        $self['ipAddress'] = $ipAddress;

        return $self;
    }
}
