<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Client;
use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Core\Util;
use Vatsense\Rates\FindRate;
use Vatsense\Rates\RateCalculatePriceParams;
use Vatsense\Rates\RateCalculatePriceParams\TaxType;
use Vatsense\Rates\RateCalculatePriceResponse;
use Vatsense\Rates\RateDetailsParams;
use Vatsense\Rates\RateFindParams;
use Vatsense\Rates\RateListParams;
use Vatsense\Rates\RateListResponse;
use Vatsense\Rates\RateListTypesResponse;
use Vatsense\RequestOptions;
use Vatsense\ServiceContracts\RatesRawContract;

/**
 * VAT/GST rate lookups for countries worldwide.
 *
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
final class RatesRawService implements RatesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns a list of VAT/GST rates for all countries, sorted alphabetically
     * by country code. Each rate is returned as a rate object containing the
     * standard rate and any other applicable rates.
     *
     * You can optionally filter by country code, IP address, or EU membership.
     *
     * @param array{
     *   countryCode?: string,
     *   eu?: bool,
     *   ipAddress?: string,
     *   period?: \DateTimeInterface,
     * }|RateListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RateListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|RateListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RateListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'rates',
            query: Util::array_transform_keys(
                $parsed,
                ['countryCode' => 'country_code', 'ipAddress' => 'ip_address']
            ),
            options: $options,
            convert: RateListResponse::class,
        );
    }

    /**
     * @api
     *
     * Combines the functionality of the "Find a tax rate" and "VAT price
     * calculation" endpoints to return the particular VAT price for an
     * applicable VAT rate. Requires both a location (country_code or ip_address)
     * and a price to calculate.
     *
     * @param array{
     *   price: string,
     *   taxType: TaxType|value-of<TaxType>,
     *   countryCode?: string,
     *   eu?: bool,
     *   ipAddress?: string,
     *   provinceCode?: string,
     *   type?: string,
     * }|RateCalculatePriceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RateCalculatePriceResponse>
     *
     * @throws APIException
     */
    public function calculatePrice(
        array|RateCalculatePriceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RateCalculatePriceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'rates/price',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'taxType' => 'tax_type',
                    'countryCode' => 'country_code',
                    'ipAddress' => 'ip_address',
                    'provinceCode' => 'province_code',
                ],
            ),
            options: $options,
            convert: RateCalculatePriceResponse::class,
        );
    }

    /**
     * @api
     *
     * Get detailed tax rate information for a location, including all applicable
     * rate classes (standard, reduced, zero, etc.).
     *
     * @param array{
     *   countryCode?: string,
     *   eu?: bool,
     *   ipAddress?: string,
     *   period?: \DateTimeInterface,
     *   provinceCode?: string,
     *   type?: string,
     * }|RateDetailsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FindRate>
     *
     * @throws APIException
     */
    public function details(
        array|RateDetailsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RateDetailsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'rates/tax_rate',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'countryCode' => 'country_code',
                    'ipAddress' => 'ip_address',
                    'provinceCode' => 'province_code',
                ],
            ),
            options: $options,
            convert: FindRate::class,
        );
    }

    /**
     * @api
     *
     * A handy endpoint for finding a rate that applies to a particular country
     * and optional product type, based on country code or IP address.
     *
     * If no type is provided, or no specific rate is applied to the given type,
     * then the standard rate will be returned if the country is subject to tax.
     *
     * If the country is not subject to VAT/GST then an error response will be
     * returned, indicating no tax applies.
     *
     * @param array{
     *   countryCode?: string,
     *   eu?: bool,
     *   ipAddress?: string,
     *   period?: \DateTimeInterface,
     *   provinceCode?: string,
     *   type?: string,
     * }|RateFindParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FindRate>
     *
     * @throws APIException
     */
    public function find(
        array|RateFindParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RateFindParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'rates/rate',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'countryCode' => 'country_code',
                    'ipAddress' => 'ip_address',
                    'provinceCode' => 'province_code',
                ],
            ),
            options: $options,
            convert: FindRate::class,
        );
    }

    /**
     * @api
     *
     * Returns a list of all available product types that can be used to filter tax rates.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RateListTypesResponse>
     *
     * @throws APIException
     */
    public function listTypes(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'rates/types',
            options: $requestOptions,
            convert: RateListTypesResponse::class,
        );
    }
}
