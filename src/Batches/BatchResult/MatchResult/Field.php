<?php

declare(strict_types=1);

namespace Vatsense\Batches\BatchResult\MatchResult;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type FieldShape = array{
 *   result?: string|null,
 *   score?: int|null,
 *   sent?: string|null,
 *   vies?: string|null,
 * }
 */
final class Field implements BaseModel
{
    /** @use SdkModel<FieldShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $result;

    #[Optional(nullable: true)]
    public ?int $score;

    /**
     * The detail as it was sent.
     */
    #[Optional(nullable: true)]
    public ?string $sent;

    #[Optional(nullable: true)]
    public ?string $vies;

    public function __construct()
    {
        $this->initialize();
    }
}
