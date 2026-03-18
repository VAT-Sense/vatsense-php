<?php

declare(strict_types=1);

namespace VatsenseVatsense\Countries;

use VatsenseVatsense\Core\Attributes\Required;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Concerns\SdkParams;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * Retrieve a list of all provinces within a given country.
 *
 * @see VatsenseVatsense\Services\CountriesService::listProvinces()
 *
 * @phpstan-type CountryListProvincesParamsShape = array{countryCode: string}
 */
final class CountryListProvincesParams implements BaseModel
{
    /** @use SdkModel<CountryListProvincesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A 2-character ISO 3166-1 alpha-2 country code (e.g. "CA").
     */
    #[Required]
    public string $countryCode;

    /**
     * `new CountryListProvincesParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CountryListProvincesParams::with(countryCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CountryListProvincesParams)->withCountryCode(...)
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
    public static function with(string $countryCode): self
    {
        $self = new self;

        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * A 2-character ISO 3166-1 alpha-2 country code (e.g. "CA").
     */
    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }
}
