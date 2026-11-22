<?php

declare(strict_types=1);

namespace Vatsense\Batches;

use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type BatchDeleteResponseShape = array{
 *   code: int,
 *   data: \Vatsense\Batches\BatchDeleteResponse\Data,
 *   success: bool,
 * }
 */
final class BatchDeleteResponse implements BaseModel
{
    /** @use SdkModel<BatchDeleteResponseShape> */
    use SdkModel;

    #[Required]
    public int $code;

    #[Required]
    public \Vatsense\Batches\BatchDeleteResponse\Data $data;

    #[Required]
    public bool $success;

    public function __construct()
    {
        $this->initialize();
    }
}
