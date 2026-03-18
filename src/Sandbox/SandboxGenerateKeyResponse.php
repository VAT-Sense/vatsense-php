<?php

declare(strict_types=1);

namespace Vatsense\Sandbox;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;
use Vatsense\Sandbox\SandboxGenerateKeyResponse\Data;

/**
 * @phpstan-import-type DataShape from \Vatsense\Sandbox\SandboxGenerateKeyResponse\Data
 *
 * @phpstan-type SandboxGenerateKeyResponseShape = array{
 *   code?: int|null, data?: null|Data|DataShape, success?: bool|null
 * }
 */
final class SandboxGenerateKeyResponse implements BaseModel
{
    /** @use SdkModel<SandboxGenerateKeyResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $code;

    #[Optional]
    public ?Data $data;

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
     * @param Data|DataShape|null $data
     */
    public static function with(
        ?int $code = null,
        Data|array|null $data = null,
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
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
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
