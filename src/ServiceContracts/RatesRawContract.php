<?php

declare(strict_types=1);

namespace VatsenseVatsense\ServiceContracts;

use VatsenseVatsense\Core\Contracts\BaseResponse;
use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\Rates\FindRate;
use VatsenseVatsense\Rates\RateCalculatePriceParams;
use VatsenseVatsense\Rates\RateCalculatePriceResponse;
use VatsenseVatsense\Rates\RateDetailsParams;
use VatsenseVatsense\Rates\RateFindParams;
use VatsenseVatsense\Rates\RateListParams;
use VatsenseVatsense\Rates\RateListResponse;
use VatsenseVatsense\Rates\RateListTypesResponse;
use VatsenseVatsense\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
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
