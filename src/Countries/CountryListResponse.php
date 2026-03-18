<?php

declare(strict_types=1);

namespace VatsenseVatsense\Countries;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CountryShape from \VatsenseVatsense\Countries\Country
 *
 * @phpstan-type CountryListResponseShape = array{
 *   code?: int|null, data?: list<Country|CountryShape>|null, success?: bool|null
 * }
 */
final class CountryListResponse implements BaseModel
{
    /** @use SdkModel<CountryListResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $code;

    /** @var list<Country>|null $data */
    #[Optional(list: Country::class)]
    public ?array $data;

    #[Optional]
    public ?bool $success;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Country|CountryShape>|null $data
     */
    public static function with(
        ?int $code = null,
        ?array $data = null,
        ?bool $success = null
    ): self {
        $self = new self;

        null !== $code && $self['code'] = $code;
        null !== $data && $self['data'] = $data;
        null !== $success && $self['success'] = $success;

        return $self;
    }

    public function withCode(int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * @param list<Country|CountryShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
