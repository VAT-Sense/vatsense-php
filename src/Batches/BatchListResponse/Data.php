<?php

declare(strict_types=1);

namespace Vatsense\Batches\BatchListResponse;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   data: array<int,mixed>,
 *   hasMore: bool,
 *   limit?: int|null,
 *   page?: int|null,
 *   total?: int|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /** @var list<\Vatsense\Batches\Batch> $data */
    #[Required(list: \Vatsense\Batches\Batch::class)]
    public array $data;

    #[Required('has_more')]
    public bool $hasMore;

    #[Optional(nullable: true)]
    public ?int $limit;

    #[Optional(nullable: true)]
    public ?int $page;

    #[Optional(nullable: true)]
    public ?int $total;

    public function __construct()
    {
        $this->initialize();
    }
}
