<?php

namespace Vatsense\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Vatsense Bad Request Exception';
}
