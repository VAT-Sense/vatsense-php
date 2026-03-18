<?php

declare(strict_types=1);

namespace Vatsense\ServiceContracts;

use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Countries\CountryListParams;
use Vatsense\Countries\CountryListProvincesParams;
use Vatsense\Countries\CountryListProvincesResponse;
use Vatsense\Countries\CountryListResponse;
use Vatsense\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
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
