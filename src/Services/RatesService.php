<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Services;

use VatsenseVatsensePhp\Client;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Core\Util;
use VatsenseVatsensePhp\Rates\FindRate;
use VatsenseVatsensePhp\Rates\RateCalculatePriceParams\TaxType;
use VatsenseVatsensePhp\Rates\RateCalculatePriceResponse;
use VatsenseVatsensePhp\Rates\RateListResponse;
use VatsenseVatsensePhp\Rates\RateListTypesResponse;
use VatsenseVatsensePhp\RequestOptions;
use VatsenseVatsensePhp\ServiceContracts\RatesContract;

/**
 * VAT/GST rate lookups for countries worldwide.
 *
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
final class RatesService implements RatesContract
{
    /**
     * @api
     */
    public RatesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RatesRawService($client);
    }

    /**
     * @api
     *
     * Returns a list of VAT/GST rates for all countries, sorted alphabetically
     * by country code. Each rate is returned as a rate object containing the
     * standard rate and any other applicable rates.
     *
     * You can optionally filter by country code, IP address, or EU membership.
     *
     * @param string $countryCode A 2-character ISO 3166-1 alpha-2 country code (e.g. "GB", "FR").
     * @param bool $eu Filter results by EU membership. Use 1 for EU countries only, 0 for non-EU only.
     * @param string $ipAddress An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     * @param \DateTimeInterface $period A historical date to retrieve rates for (format "YYYY-MM-DD HH:MM:SS"). Must be a past date.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $countryCode = null,
        ?bool $eu = null,
        ?string $ipAddress = null,
        ?\DateTimeInterface $period = null,
        RequestOptions|array|null $requestOptions = null,
    ): RateListResponse {
        $params = Util::removeNulls(
            [
                'countryCode' => $countryCode,
                'eu' => $eu,
                'ipAddress' => $ipAddress,
                'period' => $period,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Combines the functionality of the "Find a tax rate" and "VAT price
     * calculation" endpoints to return the particular VAT price for an
     * applicable VAT rate. Requires both a location (country_code or ip_address)
     * and a price to calculate.
     *
     * @param string $price The price to calculate on. Must be a string with exactly 2 decimal places (e.g. "30.00", "59.95").
     * @param TaxType|value-of<TaxType> $taxType whether the provided price is inclusive or exclusive of VAT
     * @param string $countryCode A 2-character ISO 3166-1 alpha-2 country code (e.g. "GB", "FR").
     * @param bool $eu Filter results by EU membership. Use 1 for EU countries only, 0 for non-EU only.
     * @param string $ipAddress An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     * @param string $provinceCode A 2-character province code (e.g. "NU", "NT"). If providing a province
     * code, you must also provide the relevant country_code.
     * @param string $type The product type to find the applicable rate for. See the /rates/types
     * endpoint for a full list of valid values.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function calculatePrice(
        string $price,
        TaxType|string $taxType,
        ?string $countryCode = null,
        ?bool $eu = null,
        ?string $ipAddress = null,
        ?string $provinceCode = null,
        ?string $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): RateCalculatePriceResponse {
        $params = Util::removeNulls(
            [
                'price' => $price,
                'taxType' => $taxType,
                'countryCode' => $countryCode,
                'eu' => $eu,
                'ipAddress' => $ipAddress,
                'provinceCode' => $provinceCode,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->calculatePrice(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get detailed tax rate information for a location, including all applicable
     * rate classes (standard, reduced, zero, etc.).
     *
     * @param string $countryCode A 2-character ISO 3166-1 alpha-2 country code (e.g. "GB", "FR").
     * @param bool $eu Filter results by EU membership. Use 1 for EU countries only, 0 for non-EU only.
     * @param string $ipAddress An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     * @param \DateTimeInterface $period A historical date to retrieve rates for (format "YYYY-MM-DD HH:MM:SS"). Must be a past date.
     * @param string $provinceCode A 2-character province code (e.g. "NU", "NT"). If providing a province
     * code, you must also provide the relevant country_code.
     * @param string $type The product type to find the applicable rate for. See the /rates/types
     * endpoint for a full list of valid values.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function details(
        ?string $countryCode = null,
        ?bool $eu = null,
        ?string $ipAddress = null,
        ?\DateTimeInterface $period = null,
        ?string $provinceCode = null,
        ?string $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): FindRate {
        $params = Util::removeNulls(
            [
                'countryCode' => $countryCode,
                'eu' => $eu,
                'ipAddress' => $ipAddress,
                'period' => $period,
                'provinceCode' => $provinceCode,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->details(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param string $countryCode A 2-character ISO 3166-1 alpha-2 country code (e.g. "GB", "FR").
     * @param bool $eu Filter results by EU membership. Use 1 for EU countries only, 0 for non-EU only.
     * @param string $ipAddress An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     * @param \DateTimeInterface $period A historical date to retrieve rates for (format "YYYY-MM-DD HH:MM:SS"). Must be a past date.
     * @param string $provinceCode A 2-character province code (e.g. "NU", "NT"). If providing a province
     * code, you must also provide the relevant country_code.
     * @param string $type The product type to find the applicable rate for. See the /rates/types
     * endpoint for a full list of valid values.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function find(
        ?string $countryCode = null,
        ?bool $eu = null,
        ?string $ipAddress = null,
        ?\DateTimeInterface $period = null,
        ?string $provinceCode = null,
        ?string $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): FindRate {
        $params = Util::removeNulls(
            [
                'countryCode' => $countryCode,
                'eu' => $eu,
                'ipAddress' => $ipAddress,
                'period' => $period,
                'provinceCode' => $provinceCode,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->find(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a list of all available product types that can be used to filter tax rates.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listTypes(
        RequestOptions|array|null $requestOptions = null
    ): RateListTypesResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listTypes(requestOptions: $requestOptions);

        return $response->parse();
    }
}
