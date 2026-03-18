<?php

declare(strict_types=1);

namespace VatsenseVatsense\Currency;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type VatPriceShape from \VatsenseVatsense\Currency\VatPrice
 *
 * @phpstan-type CurrencyCalculateVatPriceResponseShape = array{
 *   code?: int|null, data?: null|VatPrice|VatPriceShape, success?: bool|null
 * }
 */
final class CurrencyCalculateVatPriceResponse implements BaseModel
{
    /** @use SdkModel<CurrencyCalculateVatPriceResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $code;

    #[Optional]
    public ?VatPrice $data;

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
     * @param VatPrice|VatPriceShape|null $data
     */
    public static function with(
        ?int $code = null,
        VatPrice|array|null $data = null,
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
     * @param VatPrice|VatPriceShape $data
     */
    public function withData(VatPrice|array $data): self
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
