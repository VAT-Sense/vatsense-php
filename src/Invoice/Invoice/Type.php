<?php

declare(strict_types=1);

namespace Vatsense\Invoice\Invoice;

enum Type: string
{
    case SALE = 'sale';

    case REFUND = 'refund';
}
