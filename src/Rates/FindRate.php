<?php

declare(strict_types=1);

namespace VatsenseVatsense\Rates;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type RateWithTaxRateShape from \VatsenseVatsense\Rates\RateWithTaxRate
 *
 * @phpstan-type FindRateShape = array{
 *   code?: int|null,
 *   data?: null|RateWithTaxRate|RateWithTaxRateShape,
 *   success?: bool|null,
 * }
 */
final class FindRate implements BaseModel
{
    /** @use SdkModel<FindRateShape> */
    use SdkModel;

    #[Optional]
    public ?int $code;

    #[Optional]
    public ?RateWithTaxRate $data;

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
     * @param RateWithTaxRate|RateWithTaxRateShape|null $data
     */
    public static function with(
        ?int $code = null,
        RateWithTaxRate|array|null $data = null,
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
     * @param RateWithTaxRate|RateWithTaxRateShape $data
     */
    public function withData(RateWithTaxRate|array $data): self
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
