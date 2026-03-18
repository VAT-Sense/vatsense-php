<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Services;

use VatsenseVatsensePhp\Client;
use VatsenseVatsensePhp\Core\Contracts\BaseResponse;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Core\Util;
use VatsenseVatsensePhp\Currency\CurrencyCalculateVatPriceParams;
use VatsenseVatsensePhp\Currency\CurrencyCalculateVatPriceParams\TaxType;
use VatsenseVatsensePhp\Currency\CurrencyCalculateVatPriceResponse;
use VatsenseVatsensePhp\Currency\CurrencyConvertParams;
use VatsenseVatsensePhp\Currency\CurrencyConvertResponse;
use VatsenseVatsensePhp\Currency\CurrencyListParams;
use VatsenseVatsensePhp\Currency\CurrencyListParams\To;
use VatsenseVatsensePhp\Currency\CurrencyListResponse;
use VatsenseVatsensePhp\RequestOptions;
use VatsenseVatsensePhp\ServiceContracts\CurrencyRawContract;

/**
 * Currency exchange rates and conversion.
 *
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
final class CurrencyRawService implements CurrencyRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns a list of all currency conversion rates sourced from HMRC (GBP)
     * and the European Central Bank (EUR).
     *
     * You can optionally filter by source and target currency.
     *
     * @param array{from?: string, to?: To|value-of<To>}|CurrencyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CurrencyListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|CurrencyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CurrencyListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'currency',
            query: $parsed,
            options: $options,
            convert: CurrencyListResponse::class,
        );
    }

    /**
     * @api
     *
     * Calculate the inclusive and exclusive VAT price on a given amount and
     * VAT rate. This is a standalone calculation that does not look up rates
     * by country.
     *
     * @param array{
     *   price: string, taxType: TaxType|value-of<TaxType>, vatRate: float
     * }|CurrencyCalculateVatPriceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CurrencyCalculateVatPriceResponse>
     *
     * @throws APIException
     */
    public function calculateVatPrice(
        array|CurrencyCalculateVatPriceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CurrencyCalculateVatPriceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'currency/price',
            query: Util::array_transform_keys(
                $parsed,
                ['taxType' => 'tax_type', 'vatRate' => 'vat_rate']
            ),
            options: $options,
            convert: CurrencyCalculateVatPriceResponse::class,
        );
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
     * @param array{
     *   amount: string,
     *   from: string,
     *   to: CurrencyConvertParams\To|value-of<CurrencyConvertParams\To>,
     * }|CurrencyConvertParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CurrencyConvertResponse>
     *
     * @throws APIException
     */
    public function convert(
        array|CurrencyConvertParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CurrencyConvertParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'currency/convert',
            query: $parsed,
            options: $options,
            convert: CurrencyConvertResponse::class,
        );
    }
}
