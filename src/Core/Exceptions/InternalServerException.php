<?php

namespace VatsenseVatsensePhp\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'VatsenseVatsensePhp Internal Server Exception';
}
