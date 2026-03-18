<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\ServiceContracts;

use VatsenseVatsensePhp\Core\Contracts\BaseResponse;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Currency\CurrencyCalculateVatPriceParams;
use VatsenseVatsensePhp\Currency\CurrencyCalculateVatPriceResponse;
use VatsenseVatsensePhp\Currency\CurrencyConvertParams;
use VatsenseVatsensePhp\Currency\CurrencyConvertResponse;
use VatsenseVatsensePhp\Currency\CurrencyListParams;
use VatsenseVatsensePhp\Currency\CurrencyListResponse;
use VatsenseVatsensePhp\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
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
