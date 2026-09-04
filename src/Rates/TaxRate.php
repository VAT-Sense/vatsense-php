<?php

declare(strict_types=1);

namespace Vatsense\Rates;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;
use Vatsense\Rates\TaxRate\Object_;

/**
 * @phpstan-import-type TypesVariants from \Vatsense\Rates\TaxRate\Types
 * @phpstan-import-type TypesShape from \Vatsense\Rates\TaxRate\Types
 *
 * @phpstan-type TaxRateShape = array{
 *   class?: string|null,
 *   description?: string|null,
 *   object?: null|Object_|value-of<Object_>,
 *   rate?: float|null,
 *   taxName?: string|null,
 *   types?: TypesShape|null,
 * }
 */
final class TaxRate implements BaseModel
{
    /** @use SdkModel<TaxRateShape> */
    use SdkModel;

    /**
     * The rate tier within its tax (e.g. "standard", "reduced", "higher", "zero", "exempt").
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
     * Short name of the tax this rate belongs to (e.g. "vat", "gst", "hst", "pst", "qst", "igic", "sst"). Open vocabulary, lower case. Null where not yet classified.
     */
    #[Optional('tax_name', nullable: true)]
    public ?string $taxName;

    /**
     * Comma-separated list of product types this rate applies to, or false if it applies generally.
     *
     * @var TypesVariants|null $types
     */
    #[Optional]
    public string|bool|null $types;

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
        ?string $taxName = null,
        string|bool|null $types = null,
    ): self {
        $self = new self;

        null !== $class && $self['class'] = $class;
        null !== $description && $self['description'] = $description;
        null !== $object && $self['object'] = $object;
        null !== $rate && $self['rate'] = $rate;
        null !== $taxName && $self['taxName'] = $taxName;
        null !== $types && $self['types'] = $types;

        return $self;
    }

    /**
     * The rate tier within its tax (e.g. "standard", "reduced", "higher", "zero", "exempt").
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
    public function withObject(Object_|string $object): self
    {
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
     * Short name of the tax this rate belongs to (e.g. "vat", "gst", "hst", "pst", "qst", "igic", "sst"). Open vocabulary, lower case. Null where not yet classified.
     */
    public function withTaxName(?string $taxName): self
    {
        $self = clone $this;
        $self['taxName'] = $taxName;

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
}
