<?php

declare(strict_types=1);

namespace VatsenseVatsense\ServiceContracts;

use VatsenseVatsense\Core\Contracts\BaseResponse;
use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\Currency\CurrencyCalculateVatPriceParams;
use VatsenseVatsense\Currency\CurrencyCalculateVatPriceResponse;
use VatsenseVatsense\Currency\CurrencyConvertParams;
use VatsenseVatsense\Currency\CurrencyConvertResponse;
use VatsenseVatsense\Currency\CurrencyListParams;
use VatsenseVatsense\Currency\CurrencyListResponse;
use VatsenseVatsense\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
 */
interface CurrencyRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CurrencyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CurrencyListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|CurrencyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CurrencyCalculateVatPriceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CurrencyCalculateVatPriceResponse>
     *
     * @throws APIException
     */
    public function calculateVatPrice(
        array|CurrencyCalculateVatPriceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CurrencyConvertParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CurrencyConvertResponse>
     *
     * @throws APIException
     */
    public function convert(
        array|CurrencyConvertParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
