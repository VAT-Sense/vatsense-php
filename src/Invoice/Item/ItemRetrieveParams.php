<?php

declare(strict_types=1);

namespace Vatsense\Invoice\Item;

use Vatsense\Core\Attributes\Required;
use Vatsense\Core\Concerns\SdkModel;
use Vatsense\Core\Concerns\SdkParams;
use Vatsense\Core\Contracts\BaseModel;

/**
 * Retrieve a specific line item from an invoice.
 *
 * @see Vatsense\Services\Invoice\ItemService::retrieve()
 *
 * @phpstan-type ItemRetrieveParamsShape = array{invoiceID: string}
 */
final class ItemRetrieveParams implements BaseModel
{
    /** @use SdkModel<ItemRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $invoiceID;

    /**
     * `new ItemRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemRetrieveParams::with(invoiceID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ItemRetrieveParams)->withInvoiceID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $invoiceID): self
    {
        $self = new self;

        $self['invoiceID'] = $invoiceID;

        return $self;
    }

    public function withInvoiceID(string $invoiceID): self
    {
        $self = clone $this;
        $self['invoiceID'] = $invoiceID;

        return $self;
    }
}
