<?php

declare(strict_types=1);

namespace Vatsense\Invoice\InvoiceUpdateParams;

/**
 * The type of invoice.
 */
enum Type: string
{
    case SALE = 'sale';

    case REFUND = 'refund';
}
