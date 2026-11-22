<?php

declare(strict_types=1);

namespace Vatsense\Batches;

use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type BatchResponseShape = array{
 *   code: int,
 *   data: \Vatsense\Batches\Batch,
 *   success: bool,
 * }
 */
final class BatchResponse implements BaseModel
{
    /** @use SdkModel<BatchResponseShape> */
    use SdkModel;

    #[Required]
    public int $code;

    #[Required]
    public \Vatsense\Batches\Batch $data;

    #[Required]
    public bool $success;

    public function __construct()
    {
        $this->initialize();
    }
}
