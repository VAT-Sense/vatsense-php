<?php

namespace Vatsense\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Vatsense Unprocessable Entity Exception';
}
