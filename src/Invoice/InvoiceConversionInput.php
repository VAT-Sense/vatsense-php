<?php

declare(strict_types=1);

namespace Vatsense\Invoice;

use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvoiceConversionInputShape = array{
 *   currencyCode: string, rate: float
 * }
 */
final class InvoiceConversionInput implements BaseModel
{
    /** @use SdkModel<InvoiceConversionInputShape> */
    use SdkModel;

    /**
     * The 3-character currency code for the conversion.
     */
    #[Required('currency_code')]
    public string $currencyCode;

    /**
     * The rate of conversion.
     */
    #[Required]
    public float $rate;

    /**
     * `new InvoiceConversionInput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceConversionInput::with(currencyCode: ..., rate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceConversionInput)->withCurrencyCode(...)->withRate(...)
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
    public static function with(string $currencyCode, float $rate): self
    {
        $self = new self;

        $self['currencyCode'] = $currencyCode;
        $self['rate'] = $rate;

        return $self;
    }

    /**
     * The 3-character currency code for the conversion.
     */
    public function withCurrencyCode(string $currencyCode): self
    {
        $self = clone $this;
        $self['currencyCode'] = $currencyCode;

        return $self;
    }

    /**
     * The rate of conversion.
     */
    public function withRate(float $rate): self
    {
        $self = clone $this;
        $self['rate'] = $rate;

        return $self;
    }
}
