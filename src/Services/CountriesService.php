<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Client;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Core\Util;
use Vatsense\Countries\CountryListProvincesResponse;
use Vatsense\Countries\CountryListResponse;
use Vatsense\RequestOptions;
use Vatsense\ServiceContracts\CountriesContract;

/**
 * Country and province information.
 *
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
final class CountriesService implements CountriesContract
{
    /**
     * @api
     */
    public CountriesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CountriesRawService($client);
    }

    /**
     * @api
     *
     * Returns a list of all countries, including whether they are subject to
     * VAT/GST and whether they are subject to EU VAT. Each country is returned
     * as a country object.
     *
     * You can optionally filter by country code or IP address.
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
    ): CountryListResponse {
        $params = Util::removeNulls(
            ['countryCode' => $countryCode, 'ipAddress' => $ipAddress]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of all provinces within a given country.
     *
     * @param string $countryCode A 2-character ISO 3166-1 alpha-2 country code (e.g. "CA").
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listProvinces(
        string $countryCode,
        RequestOptions|array|null $requestOptions = null
    ): CountryListProvincesResponse {
        $params = Util::removeNulls(['countryCode' => $countryCode]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listProvinces(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
