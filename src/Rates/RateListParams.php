<?php

declare(strict_types=1);

namespace VatsenseVatsense\Rates;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Concerns\SdkParams;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * Returns a list of VAT/GST rates for all countries, sorted alphabetically
 * by country code. Each rate is returned as a rate object containing the
 * standard rate and any other applicable rates.
 *
 * You can optionally filter by country code, IP address, or EU membership.
 *
 * @see VatsenseVatsense\Services\RatesService::list()
 *
 * @phpstan-type RateListParamsShape = array{
 *   countryCode?: string|null,
 *   eu?: bool|null,
 *   ipAddress?: string|null,
 *   period?: \DateTimeInterface|null,
 * }
 */
final class RateListParams implements BaseModel
{
    /** @use SdkModel<RateListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A 2-character ISO 3166-1 alpha-2 country code (e.g. "GB", "FR").
     */
    #[Optional]
    public ?string $countryCode;

    /**
     * Filter results by EU membership. Use 1 for EU countries only, 0 for non-EU only.
     */
    #[Optional]
    public ?bool $eu;

    /**
     * An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     */
    #[Optional]
    public ?string $ipAddress;

    /**
     * A historical date to retrieve rates for (format "YYYY-MM-DD HH:MM:SS"). Must be a past date.
     */
    #[Optional]
    public ?\DateTimeInterface $period;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $countryCode = null,
        ?bool $eu = null,
        ?string $ipAddress = null,
        ?\DateTimeInterface $period = null,
    ): self {
        $self = new self;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $eu && $self['eu'] = $eu;
        null !== $ipAddress && $self['ipAddress'] = $ipAddress;
        null !== $period && $self['period'] = $period;

        return $self;
    }

    /**
     * A 2-character ISO 3166-1 alpha-2 country code (e.g. "GB", "FR").
     */
    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Filter results by EU membership. Use 1 for EU countries only, 0 for non-EU only.
     */
    public function withEu(bool $eu): self
    {
        $self = clone $this;
        $self['eu'] = $eu;

        return $self;
    }

    /**
     * An IPv4 or IPv6 address. If provided, the country will be determined from the IP address.
     */
    public function withIPAddress(string $ipAddress): self
    {
        $self = clone $this;
        $self['ipAddress'] = $ipAddress;

        return $self;
    }

    /**
     * A historical date to retrieve rates for (format "YYYY-MM-DD HH:MM:SS"). Must be a past date.
     */
    public function withPeriod(\DateTimeInterface $period): self
    {
        $self = clone $this;
        $self['period'] = $period;

        return $self;
    }
}
