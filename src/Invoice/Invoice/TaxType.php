<?php

declare(strict_types=1);

namespace Vatsense\Invoice\Invoice;

enum TaxType: string
{
    case INCL = 'incl';

    case EXCL = 'excl';
}
