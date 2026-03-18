<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Currency\VatPrice;

/**
 * Whether the price is inclusive or exclusive of VAT.
 */
enum TaxType: string
{
    case INCL = 'incl';

    case EXCL = 'excl';
}
