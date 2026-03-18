<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\ServiceContracts;

use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Currency\CurrencyCalculateVatPriceParams\TaxType;
use VatsenseVatsensePhp\Currency\CurrencyCalculateVatPriceResponse;
use VatsenseVatsensePhp\Currency\CurrencyConvertResponse;
use VatsenseVatsensePhp\Currency\CurrencyListParams\To;
use VatsenseVatsensePhp\Currency\CurrencyListResponse;
use VatsenseVatsensePhp\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
interface CurrencyContract
{
    /**
     * @api
     *
     * @param string $from The 3-character currency code(s) to convert from (e.g. "USD", "CAD").
     * Can be a comma-separated list without spaces (e.g. "USD,CAD,AUD").
     * @param To|value-of<To> $to The 3-character target currency code. Must be either "GBP" or "EUR".
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $from = null,
        To|string|null $to = null,
        RequestOptions|array|null $requestOptions = null,
    ): CurrencyListResponse;

    /**
     * @api
     *
     * @param string $price The price to calculate on. Must be a string with exactly 2 decimal places (e.g. "30.00", "59.95").
     * @param TaxType|value-of<TaxType> $taxType whether the provided price is inclusive or exclusive of VAT
     * @param float $vatRate a percentage VAT rate to use for the calculation
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function calculateVatPrice(
        string $price,
        TaxType|string $taxType,
        float $vatRate,
        RequestOptions|array|null $requestOptions = null,
    ): CurrencyCalculateVatPriceResponse;

    /**
     * @api
     *
     * @param string $amount The amount to convert. Must be a string with exactly 2 decimal places (e.g. "39.99").
     * @param string $from The 3-character source currency code (e.g. "USD", "CAD").
     * @param \VatsenseVatsensePhp\Currency\CurrencyConvertParams\To|value-of<\VatsenseVatsensePhp\Currency\CurrencyConvertParams\To> $to The 3-character target currency code. Must be either "GBP" or "EUR".
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function convert(
        string $amount,
        string $from,
        \VatsenseVatsensePhp\Currency\CurrencyConvertParams\To|string $to,
        RequestOptions|array|null $requestOptions = null,
    ): CurrencyConvertResponse;
}
