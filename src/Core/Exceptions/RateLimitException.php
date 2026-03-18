<?php

namespace VatsenseVatsensePhp\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'VatsenseVatsensePhp Rate Limit Exception';
}
