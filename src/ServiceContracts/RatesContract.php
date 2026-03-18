<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\ServiceContracts;

use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Rates\FindRate;
use VatsenseVatsensePhp\Rates\RateCalculatePriceParams\TaxType;
use VatsenseVatsensePhp\Rates\RateCalculatePriceResponse;
use VatsenseVatsensePhp\Rates\RateListResponse;
use VatsenseVatsensePhp\Rates\RateListTypesResponse;
use VatsenseVatsensePhp\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
interface RatesContract
{
    /**
     * @api
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
    ): RateListResponse;

    /**
     * @api
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
    ): RateCalculatePriceResponse;

    /**
     * @api
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
    ): FindRate;

    /**
     * @api
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
    ): FindRate;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listTypes(
        RequestOptions|array|null $requestOptions = null
    ): RateListTypesResponse;
}
