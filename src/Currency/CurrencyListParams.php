<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Currency;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Concerns\SdkParams;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;
use VatsenseVatsensePhp\Currency\CurrencyListParams\To;

/**
 * Returns a list of all currency conversion rates sourced from HMRC (GBP)
 * and the European Central Bank (EUR).
 *
 * You can optionally filter by source and target currency.
 *
 * @see VatsenseVatsensePhp\Services\CurrencyService::list()
 *
 * @phpstan-type CurrencyListParamsShape = array{
 *   from?: string|null, to?: null|To|value-of<To>
 * }
 */
final class CurrencyListParams implements BaseModel
{
    /** @use SdkModel<CurrencyListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The 3-character currency code(s) to convert from (e.g. "USD", "CAD").
     * Can be a comma-separated list without spaces (e.g. "USD,CAD,AUD").
     */
    #[Optional]
    public ?string $from;

    /**
     * The 3-character target currency code. Must be either "GBP" or "EUR".
     *
     * @var value-of<To>|null $to
     */
    #[Optional(enum: To::class)]
    public ?string $to;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param To|value-of<To>|null $to
     */
    public static function with(?string $from = null, To|string|null $to = null): self
    {
        $self = new self;

        null !== $from && $self['from'] = $from;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    /**
     * The 3-character currency code(s) to convert from (e.g. "USD", "CAD").
     * Can be a comma-separated list without spaces (e.g. "USD,CAD,AUD").
     */
    public function withFrom(string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * The 3-character target currency code. Must be either "GBP" or "EUR".
     *
     * @param To|value-of<To> $to
     */
    public function withTo(To|string $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
