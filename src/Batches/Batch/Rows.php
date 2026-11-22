<?php

declare(strict_types=1);

namespace Vatsense\Batches\Batch;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type RowsShape = array{
 *   done?: int|null,
 *   toCheck?: int|null,
 *   total?: int|null,
 * }
 */
final class Rows implements BaseModel
{
    /** @use SdkModel<RowsShape> */
    use SdkModel;

    /**
     * Rows checked so far.
     */
    #[Optional(nullable: true)]
    public ?int $done;

    /**
     * Rows that will be sent for checking.
     */
    #[Optional('to_check', nullable: true)]
    public ?int $toCheck;

    /**
     * Rows in the batch.
     */
    #[Optional(nullable: true)]
    public ?int $total;

    public function __construct()
    {
        $this->initialize();
    }
}
