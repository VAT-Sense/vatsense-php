<?php

declare(strict_types=1);

namespace Vatsense\Batches;

use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type BatchResultsResponseShape = array{
 *   code: int,
 *   data: \Vatsense\Batches\BatchResultsResponse\Data,
 *   success: bool,
 * }
 */
final class BatchResultsResponse implements BaseModel
{
    /** @use SdkModel<BatchResultsResponseShape> */
    use SdkModel;

    #[Required]
    public int $code;

    #[Required]
    public \Vatsense\Batches\BatchResultsResponse\Data $data;

    #[Required]
    public bool $success;

    public function __construct()
    {
        $this->initialize();
    }
}
