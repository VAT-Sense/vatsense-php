<?php

declare(strict_types=1);

namespace VatsenseVatsense\Rates;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;
use VatsenseVatsense\Rates\RateWithTaxRate\Object_;

/**
 * @phpstan-import-type TaxRateShape from \VatsenseVatsense\Rates\TaxRate
 *
 * @phpstan-type RateWithTaxRateShape = array{
 *   countryCode?: string|null,
 *   countryName?: string|null,
 *   eu?: bool|null,
 *   object?: null|Object_|value-of<Object_>,
 *   taxRate?: null|TaxRate|TaxRateShape,
 * }
 */
final class RateWithTaxRate implements BaseModel
{
    /** @use SdkModel<RateWithTaxRateShape> */
    use SdkModel;

    #[Optional('country_code')]
    public ?string $countryCode;

    #[Optional('country_name')]
    public ?string $countryName;

    #[Optional]
    public ?bool $eu;

    /** @var value-of<Object_>|null $object */
    #[Optional(enum: Object_::class)]
    public ?string $object;

    #[Optional('tax_rate')]
    public ?TaxRate $taxRate;

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
     * @param TaxRate|TaxRateShape|null $taxRate
     */
    public static function with(
        ?string $countryCode = null,
        ?string $countryName = null,
        ?bool $eu = null,
        Object_|string|null $object = null,
        TaxRate|array|null $taxRate = null,
    ): self {
        $self = new self;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $countryName && $self['countryName'] = $countryName;
        null !== $eu && $self['eu'] = $eu;
        null !== $object && $self['object'] = $object;
        null !== $taxRate && $self['taxRate'] = $taxRate;

        return $self;
    }

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

    public function withEu(bool $eu): self
    {
        $self = clone $this;
        $self['eu'] = $eu;

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
     * @param TaxRate|TaxRateShape $taxRate
     */
    public function withTaxRate(TaxRate|array $taxRate): self
    {
        $self = clone $this;
        $self['taxRate'] = $taxRate;

        return $self;
    }
}
