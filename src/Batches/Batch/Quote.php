<?php

declare(strict_types=1);

namespace Vatsense\Batches\Batch;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type QuoteShape = array{
 *   covered?: bool|null,
 *   overageOn?: bool|null,
 *   renewsAt?: string|null,
 *   requestsLeft?: int|null,
 *   requestsNeeded?: int|null,
 *   shortfall?: int|null,
 * }
 */
final class Quote implements BaseModel
{
    /** @use SdkModel<QuoteShape> */
    use SdkModel;

    /**
     * Whether the requests left cover the batch.
     */
    #[Optional(nullable: true)]
    public ?bool $covered;

    #[Optional('overage_on', nullable: true)]
    public ?bool $overageOn;

    #[Optional('renews_at', nullable: true)]
    public ?string $renewsAt;

    #[Optional('requests_left', nullable: true)]
    public ?int $requestsLeft;

    #[Optional('requests_needed', nullable: true)]
    public ?int $requestsNeeded;

    #[Optional(nullable: true)]
    public ?int $shortfall;

    public function __construct()
    {
        $this->initialize();
    }
}
