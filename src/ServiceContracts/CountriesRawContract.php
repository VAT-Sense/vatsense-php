<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\ServiceContracts;

use VatsenseVatsensePhp\Core\Contracts\BaseResponse;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Countries\CountryListParams;
use VatsenseVatsensePhp\Countries\CountryListProvincesParams;
use VatsenseVatsensePhp\Countries\CountryListProvincesResponse;
use VatsenseVatsensePhp\Countries\CountryListResponse;
use VatsenseVatsensePhp\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
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
