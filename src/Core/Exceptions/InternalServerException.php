<?php

namespace Vatsense\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Vatsense Internal Server Exception';
}
