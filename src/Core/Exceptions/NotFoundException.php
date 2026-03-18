<?php

namespace Vatsense\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Vatsense Not Found Exception';
}
