<?php

declare(strict_types=1);

namespace VatsenseVatsense\Invoice\InvoiceCreateParams;

/**
 * Whether item prices include or exclude VAT.
 */
enum TaxType: string
{
    case INCL = 'incl';

    case EXCL = 'excl';
}
