<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Core\Conversion\Contracts;

use VatsenseVatsensePhp\Core\Conversion\CoerceState;
use VatsenseVatsensePhp\Core\Conversion\DumpState;

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
