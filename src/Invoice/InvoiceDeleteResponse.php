<?php

declare(strict_types=1);

namespace VatsenseVatsense\Invoice;

use VatsenseVatsense\Core\Attributes\Required;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvoiceDeleteResponseShape = array{code: int, success: bool}
 */
final class InvoiceDeleteResponse implements BaseModel
{
    /** @use SdkModel<InvoiceDeleteResponseShape> */
    use SdkModel;

    #[Required]
    public int $code;

    #[Required]
    public bool $success;

    /**
     * `new InvoiceDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceDeleteResponse::with(code: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceDeleteResponse)->withCode(...)->withSuccess(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(int $code, bool $success): self
    {
        $self = new self;

        $self['code'] = $code;
        $self['success'] = $success;

        return $self;
    }

    public function withCode(int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
