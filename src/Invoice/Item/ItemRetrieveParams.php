<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Invoice\Item;

use VatsenseVatsensePhp\Core\Attributes\Required;
use VatsenseVatsensePhp\Core\Concerns\SdkModel;
use VatsenseVatsensePhp\Core\Concerns\SdkParams;
use VatsenseVatsensePhp\Core\Contracts\BaseModel;

/**
 * Retrieve a specific line item from an invoice.
 *
 * @see VatsenseVatsensePhp\Services\Invoice\ItemService::retrieve()
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
