<?php

namespace Vatsense\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Vatsense Permission Denied Exception';
}
