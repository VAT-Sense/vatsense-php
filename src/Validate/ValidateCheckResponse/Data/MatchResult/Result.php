<?php

declare(strict_types=1);

namespace Vatsense\Validate\ValidateCheckResponse\Data\MatchResult;

/**
 * likely (a score of 80 or more, and the name, if sent, is not a no_match),
 * possible (50 to 79), unlikely (under 50), or not_applicable when nothing
 * could be compared.
 */
enum Result: string
{
    case LIKELY = 'likely';

    case POSSIBLE = 'possible';

    case UNLIKELY = 'unlikely';

    case NOT_APPLICABLE = 'not_applicable';
}
