<?php

declare(strict_types=1);

namespace Vatsense\Batches;

use Vatsense\Core\Attributes\Optional;
use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Contracts\BaseModel;

/**
 * One checked row of a batch, as the CSV report lists it.
 *
 * @phpstan-type BatchResultShape = array{
 *   row: int,
 *   authority?: string|null,
 *   checkedAt?: string|null,
 *   companyAddress?: string|null,
 *   companyName?: string|null,
 *   confirmationNumber?: string|null,
 *   consultationNumber?: string|null,
 *   countryCode?: string|null,
 *   countryUploaded?: string|null,
 *   duplicateOfRow?: int|null,
 *   match?: mixed|null,
 *   reason?: string|null,
 *   repaired?: bool|null,
 *   result?: string|null,
 *   vatNumber?: string|null,
 *   vatNumberUploaded?: string|null,
 * }
 */
final class BatchResult implements BaseModel
{
    /** @use SdkModel<BatchResultShape> */
    use SdkModel;

    #[Required]
    public int $row;

    #[Optional(nullable: true)]
    public ?string $authority;

    #[Optional('checked_at', nullable: true)]
    public ?string $checkedAt;

    #[Optional('company_address', nullable: true)]
    public ?string $companyAddress;

    #[Optional('company_name', nullable: true)]
    public ?string $companyName;

    #[Optional('confirmation_number', nullable: true)]
    public ?string $confirmationNumber;

    #[Optional('consultation_number', nullable: true)]
    public ?string $consultationNumber;

    #[Optional('country_code', nullable: true)]
    public ?string $countryCode;

    #[Optional('country_uploaded', nullable: true)]
    public ?string $countryUploaded;

    #[Optional('duplicate_of_row', nullable: true)]
    public ?int $duplicateOfRow;

    #[Optional(nullable: true)]
    public ?\Vatsense\Batches\BatchResult\MatchResult $match;

    #[Optional(nullable: true)]
    public ?string $reason;

    #[Optional(nullable: true)]
    public ?bool $repaired;

    /**
     * Such as `valid` or `invalid`; `pending` while the row is being checked.
     */
    #[Optional(nullable: true)]
    public ?string $result;

    /**
     * The number as it was checked.
     */
    #[Optional('vat_number', nullable: true)]
    public ?string $vatNumber;

    #[Optional('vat_number_uploaded', nullable: true)]
    public ?string $vatNumberUploaded;

    public function __construct()
    {
        $this->initialize();
    }
}
