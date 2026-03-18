<?php

declare(strict_types=1);

namespace Vatsense\Invoice\Item;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type InvoiceItemShape from \Vatsense\Invoice\Item\InvoiceItem
 *
 * @phpstan-type ItemGetResponseShape = array{
 *   code?: int|null, data?: null|InvoiceItem|InvoiceItemShape, success?: bool|null
 * }
 */
final class ItemGetResponse implements BaseModel
{
    /** @use SdkModel<ItemGetResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $code;

    #[Optional]
    public ?InvoiceItem $data;

    #[Optional]
    public ?bool $success;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param InvoiceItem|InvoiceItemShape|null $data
     */
    public static function with(
        ?int $code = null,
        InvoiceItem|array|null $data = null,
        ?bool $success = null
    ): self {
        $self = new self;

        null !== $code && $self['code'] = $code;
        null !== $data && $self['data'] = $data;
        null !== $success && $self['success'] = $success;

        return $self;
    }

    public function withCode(int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * @param InvoiceItem|InvoiceItemShape $data
     */
    public function withData(InvoiceItem|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
