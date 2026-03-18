<?php

declare(strict_types=1);

namespace VatsenseVatsense\Usage\UsageGetResponse;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;
use VatsenseVatsense\Usage\UsageGetResponse\Data\Requests;

/**
 * @phpstan-import-type RequestsShape from \VatsenseVatsense\Usage\UsageGetResponse\Data\Requests
 *
 * @phpstan-type DataShape = array{requests?: null|Requests|RequestsShape}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Optional]
    public ?Requests $requests;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Requests|RequestsShape|null $requests
     */
    public static function with(Requests|array|null $requests = null): self
    {
        $self = new self;

        null !== $requests && $self['requests'] = $requests;

        return $self;
    }

    /**
     * @param Requests|RequestsShape $requests
     */
    public function withRequests(Requests|array $requests): self
    {
        $self = clone $this;
        $self['requests'] = $requests;

        return $self;
    }
}
