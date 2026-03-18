<?php

namespace VatsenseVatsense\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'VatsenseVatsense Permission Denied Exception';
}
