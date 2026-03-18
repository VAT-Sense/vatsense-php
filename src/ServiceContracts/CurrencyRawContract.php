<?php

declare(strict_types=1);

namespace Vatsense\ServiceContracts;

use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Currency\CurrencyCalculateVatPriceParams;
use Vatsense\Currency\CurrencyCalculateVatPriceResponse;
use Vatsense\Currency\CurrencyConvertParams;
use Vatsense\Currency\CurrencyConvertResponse;
use Vatsense\Currency\CurrencyListParams;
use Vatsense\Currency\CurrencyListResponse;
use Vatsense\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
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
