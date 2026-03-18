<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Core\Conversion;

use VatsenseVatsensePhp\Core\Conversion\Concerns\ArrayOf;
use VatsenseVatsensePhp\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
