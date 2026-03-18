<?php

namespace Vatsense\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Vatsense Authentication Exception';
}
