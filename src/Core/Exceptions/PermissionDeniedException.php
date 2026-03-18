<?php

namespace VatsenseVatsensePhp\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'VatsenseVatsensePhp Permission Denied Exception';
}
