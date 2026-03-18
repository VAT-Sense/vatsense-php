<?php

namespace VatsenseVatsense\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'VatsenseVatsense Rate Limit Exception';
}
