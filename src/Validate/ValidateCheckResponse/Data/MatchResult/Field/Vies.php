<?php

declare(strict_types=1);

namespace Vatsense\Validate\ValidateCheckResponse\Data\MatchResult\Field;

/**
 * VIES's own answer for that detail on a live EU check; null when VIES said nothing.
 */
enum Vies: string
{
    case VALID = 'valid';

    case INVALID = 'invalid';

    case NOT_PROCESSED = 'not_processed';
}
