<?php

declare(strict_types=1);

namespace Vatsense\Batches\Batch;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultsShape = array{
 *   duplicate?: int|null,
 *   invalid?: int|null,
 *   notChecked?: int|null,
 *   repaired?: int|null,
 *   retrying?: int|null,
 *   unsupported?: int|null,
 *   valid?: int|null,
 * }
 */
final class Results implements BaseModel
{
    /** @use SdkModel<ResultsShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?int $duplicate;

    #[Optional(nullable: true)]
    public ?int $invalid;

    #[Optional('not_checked', nullable: true)]
    public ?int $notChecked;

    #[Optional(nullable: true)]
    public ?int $repaired;

    #[Optional(nullable: true)]
    public ?int $retrying;

    #[Optional(nullable: true)]
    public ?int $unsupported;

    #[Optional(nullable: true)]
    public ?int $valid;

    public function __construct()
    {
        $this->initialize();
    }
}
