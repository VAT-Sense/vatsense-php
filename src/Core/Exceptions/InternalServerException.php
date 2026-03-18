<?php

namespace VatsenseVatsense\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'VatsenseVatsense Internal Server Exception';
}
