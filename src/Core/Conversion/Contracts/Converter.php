<?php

declare(strict_types=1);

namespace VatsenseVatsense\Core\Conversion\Contracts;

use VatsenseVatsense\Core\Conversion\CoerceState;
use VatsenseVatsense\Core\Conversion\DumpState;

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
