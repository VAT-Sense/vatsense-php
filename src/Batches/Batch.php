<?php

declare(strict_types=1);

namespace Vatsense\Batches;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * A batch of VAT numbers checked together.
 *
 * @phpstan-type BatchShape = array{
 *   id: string,
 *   object?: string|null,
 *   autoContinue?: bool|null,
 *   consultation?: bool|null,
 *   createdAt?: string|null,
 *   dashboardUrl?: string|null,
 *   estimatedFinishAt?: string|null,
 *   expiresAt?: string|null,
 *   finishedAt?: string|null,
 *   livemode?: bool|null,
 *   number?: int|null,
 *   pauseReason?: string|null,
 *   quote?: mixed|null,
 *   reference?: string|null,
 *   requestsUsed?: int|null,
 *   results?: mixed|null,
 *   rows?: mixed|null,
 *   source?: string|null,
 *   startedAt?: string|null,
 *   status?: string|null,
 *   trial?: bool|null,
 *   usesOverage?: bool|null,
 * }
 */
final class Batch implements BaseModel
{
    /** @use SdkModel<BatchShape> */
    use SdkModel;

    /**
     * The batch's 26-character id.
     */
    #[Required]
    public string $id;

    /**
     * Always `batch`.
     */
    #[Optional(nullable: true)]
    public ?string $object;

    #[Optional('auto_continue', nullable: true)]
    public ?bool $autoContinue;

    #[Optional(nullable: true)]
    public ?bool $consultation;

    /**
     * When the batch was made (UTC, ISO 8601, as are all the times).
     */
    #[Optional('created_at', nullable: true)]
    public ?string $createdAt;

    /**
     * The batch's page in the dashboard; null for a test batch.
     */
    #[Optional('dashboard_url', nullable: true)]
    public ?string $dashboardUrl;

    #[Optional('estimated_finish_at', nullable: true)]
    public ?string $estimatedFinishAt;

    #[Optional('expires_at', nullable: true)]
    public ?string $expiresAt;

    #[Optional('finished_at', nullable: true)]
    public ?string $finishedAt;

    /**
     * False for a test batch, made with a test key.
     */
    #[Optional(nullable: true)]
    public ?bool $livemode;

    #[Optional(nullable: true)]
    public ?int $number;

    #[Optional('pause_reason', nullable: true)]
    public ?string $pauseReason;

    /**
     * For drafts and paused batches.
     */
    #[Optional(nullable: true)]
    public ?\Vatsense\Batches\Batch\Quote $quote;

    #[Optional(nullable: true)]
    public ?string $reference;

    #[Optional('requests_used', nullable: true)]
    public ?int $requestsUsed;

    #[Optional(nullable: true)]
    public ?\Vatsense\Batches\Batch\Results $results;

    #[Optional(nullable: true)]
    public ?\Vatsense\Batches\Batch\Rows $rows;

    #[Optional(nullable: true)]
    public ?string $source;

    #[Optional('started_at', nullable: true)]
    public ?string $startedAt;

    /**
     * `draft`, `queued`, `processing`, `paused`, `complete` or `expired`.
     */
    #[Optional(nullable: true)]
    public ?string $status;

    #[Optional(nullable: true)]
    public ?bool $trial;

    #[Optional('uses_overage', nullable: true)]
    public ?bool $usesOverage;

    public function __construct()
    {
        $this->initialize();
    }
}
