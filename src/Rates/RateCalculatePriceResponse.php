<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Rates;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;
use VatsenseVatsensePhp\Rates\RateCalculatePriceResponse\Data;

/**
 * @phpstan-import-type DataShape from \VatsenseVatsensePhp\Rates\RateCalculatePriceResponse\Data
 *
 * @phpstan-type RateCalculatePriceResponseShape = array{
 *   code?: int|null, data?: null|Data|DataShape, success?: bool|null
 * }
 */
final class RateCalculatePriceResponse implements BaseModel
{
    /** @use SdkModel<RateCalculatePriceResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $code;

    #[Optional]
    public ?Data $data;

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
     * @param Data|DataShape|null $data
     */
    public static function with(
        ?int $code = null,
        Data|array|null $data = null,
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
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
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
