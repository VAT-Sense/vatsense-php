<?php

declare(strict_types=1);

namespace VatsenseVatsense\Currency\CurrencyConvertResponse;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;
use VatsenseVatsense\Currency\CurrencyConvertResponse\Data\Object_;

/**
 * @phpstan-type DataShape = array{
 *   amount?: float|null,
 *   converted?: float|null,
 *   from?: string|null,
 *   object?: null|Object_|value-of<Object_>,
 *   rate?: float|null,
 *   to?: string|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * The original amount.
     */
    #[Optional]
    public ?float $amount;

    /**
     * The converted amount.
     */
    #[Optional]
    public ?float $converted;

    #[Optional]
    public ?string $from;

    /** @var value-of<Object_>|null $object */
    #[Optional(enum: Object_::class)]
    public ?string $object;

    /**
     * The exchange rate used.
     */
    #[Optional]
    public ?float $rate;

    #[Optional]
    public ?string $to;

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
        ?float $amount = null,
        ?float $converted = null,
        ?string $from = null,
        Object_|string|null $object = null,
        ?float $rate = null,
        ?string $to = null,
    ): self {
        $self = new self;

        null !== $amount && $self['amount'] = $amount;
        null !== $converted && $self['converted'] = $converted;
        null !== $from && $self['from'] = $from;
        null !== $object && $self['object'] = $object;
        null !== $rate && $self['rate'] = $rate;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    /**
     * The original amount.
     */
    public function withAmount(float $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The converted amount.
     */
    public function withConverted(float $converted): self
    {
        $self = clone $this;
        $self['converted'] = $converted;

        return $self;
    }

    public function withFrom(string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

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
     * The exchange rate used.
     */
    public function withRate(float $rate): self
    {
        $self = clone $this;
        $self['rate'] = $rate;

        return $self;
    }

    public function withTo(string $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
