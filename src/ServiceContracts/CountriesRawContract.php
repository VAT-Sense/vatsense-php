<?php

declare(strict_types=1);

namespace VatsenseVatsense\ServiceContracts;

use VatsenseVatsense\Core\Contracts\BaseResponse;
use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\Countries\CountryListParams;
use VatsenseVatsense\Countries\CountryListProvincesParams;
use VatsenseVatsense\Countries\CountryListProvincesResponse;
use VatsenseVatsense\Countries\CountryListResponse;
use VatsenseVatsense\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
 */
interface CountriesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CountryListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CountryListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|CountryListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CountryListProvincesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CountryListProvincesResponse>
     *
     * @throws APIException
     */
    public function listProvinces(
        array|CountryListProvincesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
