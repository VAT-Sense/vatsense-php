<?php

declare(strict_types=1);

namespace VatsenseVatsense\Invoice\Invoice;

enum TaxType: string
{
    case INCL = 'incl';

    case EXCL = 'excl';
}
