<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Countries\CountryListProvincesResponse;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;
use VatsenseVatsensePhp\Countries\CountryListProvincesResponse\Data\Object_;

/**
 * @phpstan-type DataShape = array{
 *   countryCode?: string|null,
 *   object?: null|Object_|value-of<Object_>,
 *   provinceCode?: string|null,
 *   provinceName?: string|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Optional('country_code')]
    public ?string $countryCode;

    /** @var value-of<Object_>|null $object */
    #[Optional(enum: Object_::class)]
    public ?string $object;

    #[Optional('province_code')]
    public ?string $provinceCode;

    #[Optional('province_name')]
    public ?string $provinceName;

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
        Object_|string|null $object = null,
        ?string $provinceCode = null,
        ?string $provinceName = null,
    ): self {
        $self = new self;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $object && $self['object'] = $object;
        null !== $provinceCode && $self['provinceCode'] = $provinceCode;
        null !== $provinceName && $self['provinceName'] = $provinceName;

        return $self;
    }

    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

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

    public function withProvinceCode(string $provinceCode): self
    {
        $self = clone $this;
        $self['provinceCode'] = $provinceCode;

        return $self;
    }

    public function withProvinceName(string $provinceName): self
    {
        $self = clone $this;
        $self['provinceName'] = $provinceName;

        return $self;
    }
}
