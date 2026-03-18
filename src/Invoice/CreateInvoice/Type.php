<?php

declare(strict_types=1);

namespace VatsenseVatsense\Invoice\CreateInvoice;

/**
 * The type of invoice.
 */
enum Type: string
{
    case SALE = 'sale';

    case REFUND = 'refund';
}
