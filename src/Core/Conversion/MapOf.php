<?php

declare(strict_types=1);

namespace VatsenseVatsense\Core\Conversion;

use VatsenseVatsense\Core\Conversion\Concerns\ArrayOf;
use VatsenseVatsense\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
