<?php

declare(strict_types=1);

namespace Vatsense\Rates;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;
use Vatsense\Rates\Rate\Object_;
use Vatsense\Rates\Rate\Other;

/**
 * @phpstan-import-type OtherShape from \Vatsense\Rates\Rate\Other
 * @phpstan-import-type TaxRateShape from \Vatsense\Rates\TaxRate
 *
 * @phpstan-type RateShape = array{
 *   countryCode?: string|null,
 *   countryName?: string|null,
 *   eu?: bool|null,
 *   object?: null|Object_|value-of<Object_>,
 *   other?: list<Other|OtherShape>|null,
 *   standard?: null|TaxRate|TaxRateShape,
 * }
 */
final class Rate implements BaseModel
{
    /** @use SdkModel<RateShape> */
    use SdkModel;

    /**
     * 2-character ISO 3166-1 alpha-2 country code.
     */
    #[Optional('country_code')]
    public ?string $countryCode;

    #[Optional('country_name')]
    public ?string $countryName;

    /**
     * Whether the country is an EU member.
     */
    #[Optional]
    public ?bool $eu;

    /** @var value-of<Object_>|null $object */
    #[Optional(enum: Object_::class)]
    public ?string $object;

    /**
     * A list of other tax rates. Null if no additional rates exist.
     *
     * @var list<Other>|null $other
     */
    #[Optional(list: Other::class, nullable: true)]
    public ?array $other;

    #[Optional]
    public ?TaxRate $standard;

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
     * @param list<Other|OtherShape>|null $other
     * @param TaxRate|TaxRateShape|null $standard
     */
    public static function with(
        ?string $countryCode = null,
        ?string $countryName = null,
        ?bool $eu = null,
        Object_|string|null $object = null,
        ?array $other = null,
        TaxRate|array|null $standard = null,
    ): self {
        $self = new self;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $countryName && $self['countryName'] = $countryName;
        null !== $eu && $self['eu'] = $eu;
        null !== $object && $self['object'] = $object;
        null !== $other && $self['other'] = $other;
        null !== $standard && $self['standard'] = $standard;

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
     * Whether the country is an EU member.
     */
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
     * A list of other tax rates. Null if no additional rates exist.
     *
     * @param list<Other|OtherShape>|null $other
     */
    public function withOther(?array $other): self
    {
        $self = clone $this;
        $self['other'] = $other;

        return $self;
    }

    /**
     * @param TaxRate|TaxRateShape $standard
     */
    public function withStandard(TaxRate|array $standard): self
    {
        $self = clone $this;
        $self['standard'] = $standard;

        return $self;
    }
}
