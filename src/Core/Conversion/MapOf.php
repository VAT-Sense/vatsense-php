<?php

declare(strict_types=1);

namespace Vatsense\Core\Conversion;

use Vatsense\Core\Conversion\Concerns\ArrayOf;
use Vatsense\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
