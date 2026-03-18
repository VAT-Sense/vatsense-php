<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\ServiceContracts\Invoice;

use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Invoice\InvoiceResponse;
use VatsenseVatsensePhp\Invoice\Item\InvoiceItemInput;
use VatsenseVatsensePhp\Invoice\Item\ItemGetResponse;
use VatsenseVatsensePhp\RequestOptions;

/**
 * @phpstan-import-type InvoiceItemInputShape from \VatsenseVatsensePhp\Invoice\Item\InvoiceItemInput
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
interface ItemContract
{
    /**
     * @api
     *
     * @param string $itemID the unique identifier of the invoice item
     * @param string $invoiceID the unique identifier of the invoice
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $itemID,
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null,
    ): ItemGetResponse;

    /**
     * @api
     *
     * @param string $itemID path param: The unique identifier of the invoice item
     * @param string $invoiceID path param: The unique identifier of the invoice
     * @param string $item body param: The description of the line item
     * @param float $priceEach Body param: The price per item. Must be a decimal with 2 decimal places.
     * @param float $quantity body param: The quantity of the item
     * @param float $vatRate body param: A percentage VAT rate for this item
     * @param float $discountRate body param: A percentage discount to apply to the price
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $itemID,
        string $invoiceID,
        string $item,
        float $priceEach,
        float $quantity,
        float $vatRate,
        ?float $discountRate = null,
        RequestOptions|array|null $requestOptions = null,
    ): InvoiceResponse;

    /**
     * @api
     *
     * @param string $itemID the unique identifier of the invoice item
     * @param string $invoiceID the unique identifier of the invoice
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $itemID,
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null,
    ): InvoiceResponse;

    /**
     * @api
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param list<InvoiceItemInput|InvoiceItemInputShape> $items
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function add(
        string $invoiceID,
        array $items,
        RequestOptions|array|null $requestOptions = null,
    ): InvoiceResponse;
}
