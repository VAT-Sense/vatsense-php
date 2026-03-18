<?php

namespace Vatsense\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Vatsense Conflict Exception';
}
