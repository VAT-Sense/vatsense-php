<?php

declare(strict_types=1);

namespace Vatsense\Batches\BatchResultsResponse;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   data: array<int,mixed>,
 *   hasMore: bool,
 *   nextAfter?: int|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /** @var list<\Vatsense\Batches\BatchResult> $data */
    #[Required(list: \Vatsense\Batches\BatchResult::class)]
    public array $data;

    #[Required('has_more')]
    public bool $hasMore;

    /**
     * Pass as `after` for the next page while `hasMore` is true.
     */
    #[Optional('next_after', nullable: true)]
    public ?int $nextAfter;

    public function __construct()
    {
        $this->initialize();
    }
}
