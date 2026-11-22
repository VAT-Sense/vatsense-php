<?php

declare(strict_types=1);

namespace Vatsense\Batches\BatchDeleteResponse;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   id: string,
 *   deleted: bool,
 *   object?: string|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public bool $deleted;

    #[Optional(nullable: true)]
    public ?string $object;

    public function __construct()
    {
        $this->initialize();
    }
}
