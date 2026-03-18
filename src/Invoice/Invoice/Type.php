<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Invoice\Invoice;

enum Type: string
{
    case SALE = 'sale';

    case REFUND = 'refund';
}
