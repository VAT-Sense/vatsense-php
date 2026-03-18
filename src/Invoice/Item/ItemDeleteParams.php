<?php

declare(strict_types=1);

namespace VatsenseVatsense\Invoice\Item;

use VatsenseVatsense\Core\Attributes\Required;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Concerns\SdkParams;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * Remove a specific line item from an invoice.
 *
 * @see VatsenseVatsense\Services\Invoice\ItemService::delete()
 *
 * @phpstan-type ItemDeleteParamsShape = array{invoiceID: string}
 */
final class ItemDeleteParams implements BaseModel
{
    /** @use SdkModel<ItemDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $invoiceID;

    /**
     * `new ItemDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemDeleteParams::with(invoiceID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ItemDeleteParams)->withInvoiceID(...)
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
