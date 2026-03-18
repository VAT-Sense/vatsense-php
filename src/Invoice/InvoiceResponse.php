<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Invoice;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type InvoiceShape from \VatsenseVatsensePhp\Invoice\Invoice
 *
 * @phpstan-type InvoiceResponseShape = array{
 *   code?: int|null, data?: null|Invoice|InvoiceShape, success?: bool|null
 * }
 */
final class InvoiceResponse implements BaseModel
{
    /** @use SdkModel<InvoiceResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $code;

    #[Optional]
    public ?Invoice $data;

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
     * @param Invoice|InvoiceShape|null $data
     */
    public static function with(
        ?int $code = null,
        Invoice|array|null $data = null,
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
     * @param Invoice|InvoiceShape $data
     */
    public function withData(Invoice|array $data): self
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
