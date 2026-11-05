<?php

declare(strict_types=1);

namespace Vatsense\Validate\ValidateCheckResponse\Data;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;
use Vatsense\Validate\ValidateCheckResponse\Data\MatchResult\Field;
use Vatsense\Validate\ValidateCheckResponse\Data\MatchResult\Result;

/**
 * The `match` object: only when a `match_` parameter was sent. (The class is
 * not called Match because `match` is a PHP keyword.)
 *
 * @phpstan-import-type FieldShape from \Vatsense\Validate\ValidateCheckResponse\Data\MatchResult\Field
 *
 * @phpstan-type MatchResultShape = array{
 *   fields?: array<string,Field|FieldShape>|null,
 *   result?: null|Result|value-of<Result>,
 *   score?: int|null,
 * }
 */
final class MatchResult implements BaseModel
{
    /** @use SdkModel<MatchResultShape> */
    use SdkModel;

    /**
     * One entry for each detail sent (company_name, address, street, postcode, city).
     *
     * @var array<string,Field>|null $fields
     */
    #[Optional(map: Field::class)]
    public ?array $fields;

    /**
     * likely (a score of 80 or more, and the name, if sent, is not a no_match),
     * possible (50 to 79), unlikely (under 50), or not_applicable when nothing
     * could be compared.
     *
     * @var value-of<Result>|null $result
     */
    #[Optional(enum: Result::class)]
    public ?string $result;

    /**
     * The average of the details sent, with the name counting twice. null when not_applicable.
     */
    #[Optional(nullable: true)]
    public ?int $score;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,Field|FieldShape>|null $fields
     * @param Result|value-of<Result>|null $result
     */
    public static function with(
        ?array $fields = null,
        Result|string|null $result = null,
        ?int $score = null,
    ): self {
        $self = new self;

        null !== $fields && $self['fields'] = $fields;
        null !== $result && $self['result'] = $result;
        null !== $score && $self['score'] = $score;

        return $self;
    }

    /**
     * One entry for each detail sent (company_name, address, street, postcode, city).
     *
     * @param array<string,Field|FieldShape> $fields
     */
    public function withFields(array $fields): self
    {
        $self = clone $this;
        $self['fields'] = $fields;

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

    /**
     * The average of the details sent, with the name counting twice. null when not_applicable.
     */
    public function withScore(?int $score): self
    {
        $self = clone $this;
        $self['score'] = $score;

        return $self;
    }
}
