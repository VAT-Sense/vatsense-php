<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Currency\CurrencyListResponse;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;
use VatsenseVatsensePhp\Currency\CurrencyListResponse\Data\Object_;

/**
 * @phpstan-type DataShape = array{
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
     * The 3-character source currency code.
     */
    #[Optional]
    public ?string $from;

    /** @var value-of<Object_>|null $object */
    #[Optional(enum: Object_::class)]
    public ?string $object;

    /**
     * The exchange rate.
     */
    #[Optional]
    public ?float $rate;

    /**
     * The 3-character target currency code (GBP or EUR).
     */
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
        ?string $from = null,
        Object_|string|null $object = null,
        ?float $rate = null,
        ?string $to = null,
    ): self {
        $self = new self;

        null !== $from && $self['from'] = $from;
        null !== $object && $self['object'] = $object;
        null !== $rate && $self['rate'] = $rate;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    /**
     * The 3-character source currency code.
     */
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
     * The exchange rate.
     */
    public function withRate(float $rate): self
    {
        $self = clone $this;
        $self['rate'] = $rate;

        return $self;
    }

    /**
     * The 3-character target currency code (GBP or EUR).
     */
    public function withTo(string $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
