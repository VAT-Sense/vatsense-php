<?php

declare(strict_types=1);

namespace Vatsense\Invoice;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Concerns\SdkParams;
use Vatsense\Core\Contracts\BaseModel;

/**
 * Retrieve a paginated list of all invoices.
 *
 * @see Vatsense\Services\InvoiceService::list()
 *
 * @phpstan-type InvoiceListParamsShape = array{
 *   limit?: int|null, offset?: int|null, search?: string|null
 * }
 */
final class InvoiceListParams implements BaseModel
{
    /** @use SdkModel<InvoiceListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Number of invoices to return (default 10, max 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Number of invoices to skip (default 0).
     */
    #[Optional]
    public ?int $offset;

    /**
     * Search query to filter invoices.
     */
    #[Optional]
    public ?string $search;

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
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $search && $self['search'] = $search;

        return $self;
    }

    /**
     * Number of invoices to return (default 10, max 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Number of invoices to skip (default 0).
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Search query to filter invoices.
     */
    public function withSearch(string $search): self
    {
        $self = clone $this;
        $self['search'] = $search;

        return $self;
    }
}
