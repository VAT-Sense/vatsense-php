<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Invoice\CreateInvoice;

/**
 * Whether item prices include or exclude VAT.
 */
enum TaxType: string
{
    case INCL = 'incl';

    case EXCL = 'excl';
}
