<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Countries;

use VatsenseVatsensePhp\Core\Attributes\Optional;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;
use VatsenseVatsensePhp\Countries\CountryListProvincesResponse\Data;

/**
 * @phpstan-import-type DataShape from \VatsenseVatsensePhp\Countries\CountryListProvincesResponse\Data
 *
 * @phpstan-type CountryListProvincesResponseShape = array{
 *   code?: int|null, data?: list<Data|DataShape>|null, success?: bool|null
 * }
 */
final class CountryListProvincesResponse implements BaseModel
{
    /** @use SdkModel<CountryListProvincesResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $code;

    /** @var list<Data>|null $data */
    #[Optional(list: Data::class)]
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
     * @param list<Data|DataShape>|null $data
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
     * @param list<Data|DataShape> $data
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
