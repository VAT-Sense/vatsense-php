<?php

declare(strict_types=1);

namespace Vatsense\Currency\CurrencyListParams;

/**
 * The 3-character target currency code. Must be either "GBP" or "EUR".
 */
enum To: string
{
    case GBP = 'GBP';

    case EUR = 'EUR';
}
