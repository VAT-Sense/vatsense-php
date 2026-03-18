<?php

declare(strict_types=1);

namespace VatsenseVatsense\Sandbox\SandboxGenerateKeyResponse;

use VatsenseVatsense\Core\Attributes\Optional;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   allowedEndpoints?: list<string>|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   key?: string|null,
 *   requestsRemaining?: int|null,
 *   signupURL?: string|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /** @var list<string>|null $allowedEndpoints */
    #[Optional('allowed_endpoints', list: 'string')]
    public ?array $allowedEndpoints;

    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    /**
     * The temporary sandbox API key.
     */
    #[Optional]
    public ?string $key;

    #[Optional('requests_remaining')]
    public ?int $requestsRemaining;

    #[Optional('signup_url')]
    public ?string $signupURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $allowedEndpoints
     */
    public static function with(
        ?array $allowedEndpoints = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $key = null,
        ?int $requestsRemaining = null,
        ?string $signupURL = null,
    ): self {
        $self = new self;

        null !== $allowedEndpoints && $self['allowedEndpoints'] = $allowedEndpoints;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $key && $self['key'] = $key;
        null !== $requestsRemaining && $self['requestsRemaining'] = $requestsRemaining;
        null !== $signupURL && $self['signupURL'] = $signupURL;

        return $self;
    }

    /**
     * @param list<string> $allowedEndpoints
     */
    public function withAllowedEndpoints(array $allowedEndpoints): self
    {
        $self = clone $this;
        $self['allowedEndpoints'] = $allowedEndpoints;

        return $self;
    }

    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The temporary sandbox API key.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    public function withRequestsRemaining(int $requestsRemaining): self
    {
        $self = clone $this;
        $self['requestsRemaining'] = $requestsRemaining;

        return $self;
    }

    public function withSignupURL(string $signupURL): self
    {
        $self = clone $this;
        $self['signupURL'] = $signupURL;

        return $self;
    }
}
