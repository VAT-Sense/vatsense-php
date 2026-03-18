<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\ServiceContracts;

use VatsenseVatsensePhp\Core\Contracts\BaseResponse;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Rates\FindRate;
use VatsenseVatsensePhp\Rates\RateCalculatePriceParams;
use VatsenseVatsensePhp\Rates\RateCalculatePriceResponse;
use VatsenseVatsensePhp\Rates\RateDetailsParams;
use VatsenseVatsensePhp\Rates\RateFindParams;
use VatsenseVatsensePhp\Rates\RateListParams;
use VatsenseVatsensePhp\Rates\RateListResponse;
use VatsenseVatsensePhp\Rates\RateListTypesResponse;
use VatsenseVatsensePhp\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
interface RatesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RateListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RateListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|RateListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RateCalculatePriceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RateCalculatePriceResponse>
     *
     * @throws APIException
     */
    public function calculatePrice(
        array|RateCalculatePriceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RateDetailsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FindRate>
     *
     * @throws APIException
     */
    public function details(
        array|RateDetailsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RateFindParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FindRate>
     *
     * @throws APIException
     */
    public function find(
        array|RateFindParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RateListTypesResponse>
     *
     * @throws APIException
     */
    public function listTypes(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
