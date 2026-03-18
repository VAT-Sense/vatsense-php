<?php

declare(strict_types=1);

namespace VatsenseVatsense\Invoice\Item;

use VatsenseVatsense\Core\Attributes\Required;
use VatsenseVatsense\Core\Concerns\SdkModel;
use VatsenseVatsense\Core\Concerns\SdkParams;
use VatsenseVatsense\Core\Contracts\BaseModel;

/**
 * Add one or more line items to an existing invoice.
 *
 * @see VatsenseVatsense\Services\Invoice\ItemService::add()
 *
 * @phpstan-import-type InvoiceItemInputShape from \VatsenseVatsense\Invoice\Item\InvoiceItemInput
 *
 * @phpstan-type ItemAddParamsShape = array{
 *   items: list<InvoiceItemInput|InvoiceItemInputShape>
 * }
 */
final class ItemAddParams implements BaseModel
{
    /** @use SdkModel<ItemAddParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<InvoiceItemInput> $items */
    #[Required(list: InvoiceItemInput::class)]
    public array $items;

    /**
     * `new ItemAddParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemAddParams::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ItemAddParams)->withItems(...)
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
     *
     * @param list<InvoiceItemInput|InvoiceItemInputShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<InvoiceItemInput|InvoiceItemInputShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
