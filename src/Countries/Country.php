<?php

declare(strict_types=1);

namespace VatsenseVatsense\Countries;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;
use VatsenseVatsense\Countries\Country\Object_;

/**
 * @phpstan-type CountryShape = array{
 *   countryCode?: string|null,
 *   countryName?: string|null,
 *   eu?: bool|null,
 *   latitude?: float|null,
 *   longitude?: float|null,
 *   object?: null|Object_|value-of<Object_>,
 *   vat?: bool|null,
 * }
 */
final class Country implements BaseModel
{
    /** @use SdkModel<CountryShape> */
    use SdkModel;

    /**
     * 2-character ISO 3166-1 alpha-2 country code.
     */
    #[Optional('country_code')]
    public ?string $countryCode;

    #[Optional('country_name')]
    public ?string $countryName;

    /**
     * Whether the country is subject to EU VAT.
     */
    #[Optional]
    public ?bool $eu;

    #[Optional]
    public ?float $latitude;

    #[Optional]
    public ?float $longitude;

    /** @var value-of<Object_>|null $object */
    #[Optional(enum: Object_::class)]
    public ?string $object;

    /**
     * Whether the country is subject to VAT/GST.
     */
    #[Optional]
    public ?bool $vat;

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
        ?string $countryCode = null,
        ?string $countryName = null,
        ?bool $eu = null,
        ?float $latitude = null,
        ?float $longitude = null,
        Object_|string|null $object = null,
        ?bool $vat = null,
    ): self {
        $self = new self;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $countryName && $self['countryName'] = $countryName;
        null !== $eu && $self['eu'] = $eu;
        null !== $latitude && $self['latitude'] = $latitude;
        null !== $longitude && $self['longitude'] = $longitude;
        null !== $object && $self['object'] = $object;
        null !== $vat && $self['vat'] = $vat;

        return $self;
    }

    /**
     * 2-character ISO 3166-1 alpha-2 country code.
     */
    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    public function withCountryName(string $countryName): self
    {
        $self = clone $this;
        $self['countryName'] = $countryName;

        return $self;
    }

    /**
     * Whether the country is subject to EU VAT.
     */
    public function withEu(bool $eu): self
    {
        $self = clone $this;
        $self['eu'] = $eu;

        return $self;
    }

    public function withLatitude(float $latitude): self
    {
        $self = clone $this;
        $self['latitude'] = $latitude;

        return $self;
    }

    public function withLongitude(float $longitude): self
    {
        $self = clone $this;
        $self['longitude'] = $longitude;

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
     * Whether the country is subject to VAT/GST.
     */
    public function withVat(bool $vat): self
    {
        $self = clone $this;
        $self['vat'] = $vat;

        return $self;
    }
}
