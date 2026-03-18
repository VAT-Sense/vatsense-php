<?php

declare(strict_types=1);

namespace VatsenseVatsense\ServiceContracts;

use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\Countries\CountryListProvincesResponse;
use VatsenseVatsense\Countries\CountryListResponse;
use VatsenseVatsense\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
 */
interface CountriesContract
{
    /**
     * @api
     *
     * @param string $countryCode A 2-character ISO 3166-1 alpha-2 country code (e.g. "GB", "FR").
     * @param string $ipAddress An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $countryCode = null,
        ?string $ipAddress = null,
        RequestOptions|array|null $requestOptions = null,
    ): CountryListResponse;

    /**
     * @api
     *
     * @param string $countryCode A 2-character ISO 3166-1 alpha-2 country code (e.g. "CA").
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listProvinces(
        string $countryCode,
        RequestOptions|array|null $requestOptions = null
    ): CountryListProvincesResponse;
}
