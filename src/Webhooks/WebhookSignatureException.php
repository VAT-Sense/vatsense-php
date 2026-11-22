<?php

declare(strict_types=1);

namespace Vatsense\Webhooks;

use Vatsense\Core\Exceptions\VatsenseException;

/**
 * The event's signature is missing, malformed, too old or does not match.
 */
final class WebhookSignatureException extends VatsenseException
{
    /** @var string */
    protected const DESC = 'Vatsense Webhook Signature Error';
}
