<?php

declare(strict_types=1);

namespace Vatsense\Currency;

use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Concerns\SdkParams;
use Vatsense\Core\Contracts\BaseModel;
use Vatsense\Currency\CurrencyConvertParams\To;

/**
 * Convert a foreign currency amount to either GBP or EUR using official
 * exchange rates.
 *
 * GBP rates are from HMRC (updated on the 1st of every month).
 * EUR rates are from the European Central Bank (updated around 16:00 CET
 * on working days).
 *
 * @see Vatsense\Services\CurrencyService::convert()
 *
 * @phpstan-type CurrencyConvertParamsShape = array{
 *   amount: string, from: string, to: To|value-of<To>
 * }
 */
final class CurrencyConvertParams implements BaseModel
{
    /** @use SdkModel<CurrencyConvertParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The amount to convert. Must be a string with exactly 2 decimal places (e.g. "39.99").
     */
    #[Required]
    public string $amount;

    /**
     * The 3-character source currency code (e.g. "USD", "CAD").
     */
    #[Required]
    public string $from;

    /**
     * The 3-character target currency code. Must be either "GBP" or "EUR".
     *
     * @var value-of<To> $to
     */
    #[Required(enum: To::class)]
    public string $to;

    /**
     * `new CurrencyConvertParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CurrencyConvertParams::with(amount: ..., from: ..., to: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CurrencyConvertParams)->withAmount(...)->withFrom(...)->withTo(...)
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
     *
     * @param To|value-of<To> $to
     */
    public static function with(
        string $amount,
        string $from,
        To|string $to
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['from'] = $from;
        $self['to'] = $to;

        return $self;
    }

    /**
     * The amount to convert. Must be a string with exactly 2 decimal places (e.g. "39.99").
     */
    public function withAmount(string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The 3-character source currency code (e.g. "USD", "CAD").
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
