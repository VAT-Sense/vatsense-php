<?php

declare(strict_types=1);

namespace VatsenseVatsense\Invoice\InvoiceCreateParams;

/**
 * The type of invoice.
 */
enum Type: string
{
    case SALE = 'sale';

    case REFUND = 'refund';
}
