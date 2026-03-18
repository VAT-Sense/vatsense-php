<?php

declare(strict_types=1);

namespace Vatsense\Rates\Rate;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;
use Vatsense\Rates\TaxRate\Object_;

/**
 * @phpstan-import-type TypesVariants from \Vatsense\Rates\TaxRate\Types
 * @phpstan-import-type TypesShape from \Vatsense\Rates\TaxRate\Types
 *
 * @phpstan-type OtherShape = array{
 *   class?: string|null,
 *   description?: string|null,
 *   object?: null|\Vatsense\Rates\TaxRate\Object_|value-of<\Vatsense\Rates\TaxRate\Object_>,
 *   rate?: float|null,
 *   types?: TypesShape|null,
 *   province?: string|null,
 * }
 */
final class Other implements BaseModel
{
    /** @use SdkModel<OtherShape> */
    use SdkModel;

    /**
     * The rate class (e.g. "standard", "reduced", "zero").
     */
    #[Optional]
    public ?string $class;

    /**
     * A description of what goods/services this rate applies to.
     */
    #[Optional]
    public ?string $description;

    /** @var value-of<Object_>|null $object */
    #[Optional(enum: Object_::class)]
    public ?string $object;

    /**
     * The tax rate percentage.
     */
    #[Optional]
    public ?float $rate;

    /**
     * Comma-separated list of product types this rate applies to, or false if it applies generally.
     *
     * @var TypesVariants|null $types
     */
    #[Optional]
    public string|bool|null $types;

    /**
     * The province this rate applies to, if applicable.
     */
    #[Optional(nullable: true)]
    public ?string $province;

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
     * @param TypesShape|null $types
     */
    public static function with(
        ?string $class = null,
        ?string $description = null,
        Object_|string|null $object = null,
        ?float $rate = null,
        string|bool|null $types = null,
        ?string $province = null,
    ): self {
        $self = new self;

        null !== $class && $self['class'] = $class;
        null !== $description && $self['description'] = $description;
        null !== $object && $self['object'] = $object;
        null !== $rate && $self['rate'] = $rate;
        null !== $types && $self['types'] = $types;
        null !== $province && $self['province'] = $province;

        return $self;
    }

    /**
     * The rate class (e.g. "standard", "reduced", "zero").
     */
    public function withClass(string $class): self
    {
        $self = clone $this;
        $self['class'] = $class;

        return $self;
    }

    /**
     * A description of what goods/services this rate applies to.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * @param Object_|value-of<Object_> $object
     */
    public function withObject(
        Object_|string $object
    ): self {
        $self = clone $this;
        $self['object'] = $object;

        return $self;
    }

    /**
     * The tax rate percentage.
     */
    public function withRate(float $rate): self
    {
        $self = clone $this;
        $self['rate'] = $rate;

        return $self;
    }

    /**
     * Comma-separated list of product types this rate applies to, or false if it applies generally.
     *
     * @param TypesShape $types
     */
    public function withTypes(string|bool $types): self
    {
        $self = clone $this;
        $self['types'] = $types;

        return $self;
    }

    /**
     * The province this rate applies to, if applicable.
     */
    public function withProvince(?string $province): self
    {
        $self = clone $this;
        $self['province'] = $province;

        return $self;
    }
}
