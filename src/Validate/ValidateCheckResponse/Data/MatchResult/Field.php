<?php

declare(strict_types=1);

namespace Vatsense\Validate\ValidateCheckResponse\Data\MatchResult;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;
use Vatsense\Validate\ValidateCheckResponse\Data\MatchResult\Field\Result;
use Vatsense\Validate\ValidateCheckResponse\Data\MatchResult\Field\Vies;

/**
 * How one detail you sent compared with the registered details.
 *
 * @phpstan-type FieldShape = array{
 *   result?: null|Result|value-of<Result>,
 *   score?: int|null,
 *   vies?: null|Vies|value-of<Vies>,
 * }
 */
final class Field implements BaseModel
{
    /** @use SdkModel<FieldShape> */
    use SdkModel;

    /** @var value-of<Result>|null $result */
    #[Optional(enum: Result::class)]
    public ?string $result;

    #[Optional(nullable: true)]
    public ?int $score;

    /**
     * VIES's own answer for that detail on a live EU check; null when VIES said nothing.
     *
     * @var value-of<Vies>|null $vies
     */
    #[Optional(enum: Vies::class, nullable: true)]
    public ?string $vies;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Result|value-of<Result>|null $result
     * @param Vies|value-of<Vies>|null $vies
     */
    public static function with(
        Result|string|null $result = null,
        ?int $score = null,
        Vies|string|null $vies = null,
    ): self {
        $self = new self;

        null !== $result && $self['result'] = $result;
        null !== $score && $self['score'] = $score;
        null !== $vies && $self['vies'] = $vies;

        return $self;
    }

    /**
     * @param Result|value-of<Result> $result
     */
    public function withResult(Result|string $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }

    public function withScore(?int $score): self
    {
        $self = clone $this;
        $self['score'] = $score;

        return $self;
    }

    /**
     * VIES's own answer for that detail on a live EU check; null when VIES said nothing.
     *
     * @param Vies|value-of<Vies>|null $vies
     */
    public function withVies(Vies|string|null $vies): self
    {
        $self = clone $this;
        $self['vies'] = $vies;

        return $self;
    }
}
