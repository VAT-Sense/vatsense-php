<?php

declare(strict_types=1);

namespace Vatsense\Rates\RateCalculatePriceParams;

/**
 * Whether the provided price is inclusive or exclusive of VAT.
 */
enum TaxType: string
{
    case INCL = 'incl';

    case EXCL = 'excl';
}
