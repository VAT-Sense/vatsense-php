<?php

declare(strict_types=1);

namespace Vatsense\Core\Conversion\Contracts;

use Vatsense\Core\Conversion\CoerceState;
use Vatsense\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
