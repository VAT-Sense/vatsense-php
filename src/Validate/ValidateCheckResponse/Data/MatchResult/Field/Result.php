<?php

declare(strict_types=1);

namespace Vatsense\Validate\ValidateCheckResponse\Data\MatchResult\Field;

enum Result: string
{
    case MATCH = 'match';

    case PARTIAL = 'partial';

    case NO_MATCH = 'no_match';

    case NOT_APPLICABLE = 'not_applicable';
}
