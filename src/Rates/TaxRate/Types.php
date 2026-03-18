<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Rates\TaxRate;

use VatsenseVatsensePhp\Core\Concerns\SdkUnion;
use VatsenseVatsensePhp\Core\Conversion\Contracts\Converter;
use VatsenseVatsensePhp\Core\Conversion\Contracts\ConverterSource;

/**
 * Comma-separated list of product types this rate applies to, or false if it applies generally.
 *
 * @phpstan-type TypesVariants = string|bool
 * @phpstan-type TypesShape = TypesVariants
 */
final class Types implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'bool'];
    }
}
