<?php

declare(strict_types=1);

namespace Vatsense\Core\Conversion;

use Vatsense\Core\Conversion\Concerns\ArrayOf;
use Vatsense\Core\Conversion\Contracts\Converter;

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
