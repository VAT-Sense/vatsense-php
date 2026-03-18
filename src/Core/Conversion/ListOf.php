<?php

declare(strict_types=1);

namespace VatsenseVatsense\Core\Conversion;

use VatsenseVatsense\Core\Conversion\Concerns\ArrayOf;
use VatsenseVatsense\Core\Conversion\Contracts\Converter;

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
