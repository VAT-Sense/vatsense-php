<?php

declare(strict_types=1);

namespace Vatsense\Usage\UsageGetResponse\Data;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type RequestsShape = array{
 *   remaining?: int|null, total?: int|null, used?: int|null
 * }
 */
final class Requests implements BaseModel
{
    /** @use SdkModel<RequestsShape> */
    use SdkModel;

    /**
     * Requests remaining before the limit is reached.
     */
    #[Optional]
    public ?int $remaining;

    /**
     * Total requests allowed on your plan.
     */
    #[Optional]
    public ?int $total;

    /**
     * Requests used in the last 30 days.
     */
    #[Optional]
    public ?int $used;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?int $remaining = null,
        ?int $total = null,
        ?int $used = null
    ): self {
        $self = new self;

        null !== $remaining && $self['remaining'] = $remaining;
        null !== $total && $self['total'] = $total;
        null !== $used && $self['used'] = $used;

        return $self;
    }

    /**
     * Requests remaining before the limit is reached.
     */
    public function withRemaining(int $remaining): self
    {
        $self = clone $this;
        $self['remaining'] = $remaining;

        return $self;
    }

    /**
     * Total requests allowed on your plan.
     */
    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    /**
     * Requests used in the last 30 days.
     */
    public function withUsed(int $used): self
    {
        $self = clone $this;
        $self['used'] = $used;

        return $self;
    }
}
