<?php

declare(strict_types=1);

namespace Vatsense\ServiceContracts;

use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Rates\FindRate;
use Vatsense\Rates\RateCalculatePriceParams;
use Vatsense\Rates\RateCalculatePriceResponse;
use Vatsense\Rates\RateDetailsParams;
use Vatsense\Rates\RateFindParams;
use Vatsense\Rates\RateListParams;
use Vatsense\Rates\RateListResponse;
use Vatsense\Rates\RateListTypesResponse;
use Vatsense\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
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
