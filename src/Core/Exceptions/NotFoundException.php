<?php

namespace VatsenseVatsensePhp\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'VatsenseVatsensePhp Not Found Exception';
}
