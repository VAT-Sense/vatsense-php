<?php

declare(strict_types=1);

namespace Vatsense\Batches\BatchResult;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type MatchResultShape = array{
 *   fields?: array<string,mixed>|null,
 *   result?: string|null,
 *   score?: int|null,
 * }
 */
final class MatchResult implements BaseModel
{
    /** @use SdkModel<MatchResultShape> */
    use SdkModel;

    /** @var array<string,Field>|null $fields */
    #[Optional(map: Field::class, nullable: true)]
    public ?array $fields;

    /**
     * `likely`, `possible`, `unlikely` or `not_applicable`.
     */
    #[Optional(nullable: true)]
    public ?string $result;

    #[Optional(nullable: true)]
    public ?int $score;

    public function __construct()
    {
        $this->initialize();
    }
}
