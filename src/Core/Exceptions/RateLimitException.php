<?php

namespace Vatsense\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Vatsense Rate Limit Exception';
}
