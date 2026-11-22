<?php

declare(strict_types=1);

namespace Vatsense\Batches;

use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type BatchListResponseShape = array{
 *   code: int,
 *   data: \Vatsense\Batches\BatchListResponse\Data,
 *   success: bool,
 * }
 */
final class BatchListResponse implements BaseModel
{
    /** @use SdkModel<BatchListResponseShape> */
    use SdkModel;

    #[Required]
    public int $code;

    #[Required]
    public \Vatsense\Batches\BatchListResponse\Data $data;

    #[Required]
    public bool $success;

    public function __construct()
    {
        $this->initialize();
    }
}
