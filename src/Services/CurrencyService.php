<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Client;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Core\Util;
use Vatsense\Currency\CurrencyCalculateVatPriceParams\TaxType;
use Vatsense\Currency\CurrencyCalculateVatPriceResponse;
use Vatsense\Currency\CurrencyConvertResponse;
use Vatsense\Currency\CurrencyListParams\To;
use Vatsense\Currency\CurrencyListResponse;
use Vatsense\RequestOptions;
use Vatsense\ServiceContracts\CurrencyContract;

/**
 * Currency exchange rates and conversion.
 *
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
final class CurrencyService implements CurrencyContract
{
    /**
     * @api
     */
    public CurrencyRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CurrencyRawService($client);
    }

    /**
     * @api
     *
     * Returns a list of all currency conversion rates sourced from HMRC (GBP)
     * and the European Central Bank (EUR).
     *
     * You can optionally filter by source and target currency.
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
    ): CurrencyListResponse {
        $params = Util::removeNulls(['from' => $from, 'to' => $to]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Calculate the inclusive and exclusive VAT price on a given amount and
     * VAT rate. This is a standalone calculation that does not look up rates
     * by country.
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
    ): CurrencyCalculateVatPriceResponse {
        $params = Util::removeNulls(
            ['price' => $price, 'taxType' => $taxType, 'vatRate' => $vatRate]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->calculateVatPrice(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Convert a foreign currency amount to either GBP or EUR using official
     * exchange rates.
     *
     * GBP rates are from HMRC (updated on the 1st of every month).
     * EUR rates are from the European Central Bank (updated around 16:00 CET
     * on working days).
     *
     * @param string $amount The amount to convert. Must be a string with exactly 2 decimal places (e.g. "39.99").
     * @param string $from The 3-character source currency code (e.g. "USD", "CAD").
     * @param \Vatsense\Currency\CurrencyConvertParams\To|value-of<\Vatsense\Currency\CurrencyConvertParams\To> $to The 3-character target currency code. Must be either "GBP" or "EUR".
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function convert(
        string $amount,
        string $from,
        \Vatsense\Currency\CurrencyConvertParams\To|string $to,
        RequestOptions|array|null $requestOptions = null,
    ): CurrencyConvertResponse {
        $params = Util::removeNulls(
            ['amount' => $amount, 'from' => $from, 'to' => $to]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->convert(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
