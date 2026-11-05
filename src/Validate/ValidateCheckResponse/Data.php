<?php

declare(strict_types=1);

namespace Vatsense\Validate\ValidateCheckResponse;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;
use Vatsense\Validate\ValidateCheckResponse\Data\Company\EoriValidationCompany;
use Vatsense\Validate\ValidateCheckResponse\Data\Company\ValidationCompany;
use Vatsense\Validate\ValidateCheckResponse\Data\MatchResult;

/**
 * @phpstan-import-type CompanyVariants from \Vatsense\Validate\ValidateCheckResponse\Data\Company
 * @phpstan-import-type CompanyShape from \Vatsense\Validate\ValidateCheckResponse\Data\Company
 * @phpstan-import-type MatchResultShape from \Vatsense\Validate\ValidateCheckResponse\Data\MatchResult
 *
 * @phpstan-type DataShape = array{
 *   company?: CompanyShape|null,
 *   consultationNumber?: string|null,
 *   match?: null|MatchResult|MatchResultShape,
 *   valid?: bool|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /** @var CompanyVariants|null $company */
    #[Optional]
    public ValidationCompany|EoriValidationCompany|null $company;

    /**
     * Official consultation number (only returned when requester_vat_number is provided).
     */
    #[Optional('consultation_number', nullable: true)]
    public ?string $consultationNumber;

    /**
     * Only when a `match_` parameter was sent.
     */
    #[Optional]
    public ?MatchResult $match;

    /**
     * Whether the VAT/EORI number is valid.
     */
    #[Optional]
    public ?bool $valid;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CompanyShape|null $company
     * @param MatchResult|MatchResultShape|null $match
     */
    public static function with(
        ValidationCompany|array|EoriValidationCompany|null $company = null,
        ?string $consultationNumber = null,
        ?bool $valid = null,
        MatchResult|array|null $match = null,
    ): self {
        $self = new self;

        null !== $company && $self['company'] = $company;
        null !== $consultationNumber && $self['consultationNumber'] = $consultationNumber;
        null !== $valid && $self['valid'] = $valid;
        null !== $match && $self['match'] = $match;

        return $self;
    }

    /**
     * @param CompanyShape $company
     */
    public function withCompany(
        ValidationCompany|array|EoriValidationCompany $company
    ): self {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    /**
     * Official consultation number (only returned when requester_vat_number is provided).
     */
    public function withConsultationNumber(?string $consultationNumber): self
    {
        $self = clone $this;
        $self['consultationNumber'] = $consultationNumber;

        return $self;
    }

    /**
     * Whether the VAT/EORI number is valid.
     */
    public function withValid(bool $valid): self
    {
        $self = clone $this;
        $self['valid'] = $valid;

        return $self;
    }

    /**
     * Only when a `match_` parameter was sent.
     *
     * @param MatchResult|MatchResultShape $match
     */
    public function withMatch(MatchResult|array $match): self
    {
        $self = clone $this;
        $self['match'] = $match;

        return $self;
    }
}
