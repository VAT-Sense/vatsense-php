<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Client;
use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Core\Util;
use Vatsense\Countries\CountryListParams;
use Vatsense\Countries\CountryListProvincesParams;
use Vatsense\Countries\CountryListProvincesResponse;
use Vatsense\Countries\CountryListResponse;
use Vatsense\RequestOptions;
use Vatsense\ServiceContracts\CountriesRawContract;

/**
 * Country and province information.
 *
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
final class CountriesRawService implements CountriesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns a list of all countries, including whether they are subject to
     * VAT/GST and whether they are subject to EU VAT. Each country is returned
     * as a country object.
     *
     * You can optionally filter by country code or IP address.
     *
     * @param array{countryCode?: string, ipAddress?: string}|CountryListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CountryListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|CountryListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CountryListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'countries',
            query: Util::array_transform_keys(
                $parsed,
                ['countryCode' => 'country_code', 'ipAddress' => 'ip_address']
            ),
            options: $options,
            convert: CountryListResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a list of all provinces within a given country.
     *
     * @param array{countryCode: string}|CountryListProvincesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CountryListProvincesResponse>
     *
     * @throws APIException
     */
    public function listProvinces(
        array|CountryListProvincesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CountryListProvincesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'countries/provinces',
            query: Util::array_transform_keys(
                $parsed,
                ['countryCode' => 'country_code']
            ),
            options: $options,
            convert: CountryListProvincesResponse::class,
        );
    }
}
