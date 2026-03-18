<?php

declare(strict_types=1);

namespace Vatsense\Services\Invoice;

use Vatsense\Client;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Core\Util;
use Vatsense\Invoice\InvoiceResponse;
use Vatsense\Invoice\Item\InvoiceItemInput;
use Vatsense\Invoice\Item\ItemGetResponse;
use Vatsense\RequestOptions;
use Vatsense\ServiceContracts\Invoice\ItemContract;

/**
 * VAT-compliant invoice management.
 *
 * @phpstan-import-type InvoiceItemInputShape from \Vatsense\Invoice\Item\InvoiceItemInput
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
final class ItemService implements ItemContract
{
    /**
     * @api
     */
    public ItemRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ItemRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a specific line item from an invoice.
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
    ): ItemGetResponse {
        $params = Util::removeNulls(['invoiceID' => $invoiceID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($itemID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a specific line item on an invoice.
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
    ): InvoiceResponse {
        $params = Util::removeNulls(
            [
                'invoiceID' => $invoiceID,
                'item' => $item,
                'priceEach' => $priceEach,
                'quantity' => $quantity,
                'vatRate' => $vatRate,
                'discountRate' => $discountRate,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($itemID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove a specific line item from an invoice.
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
    ): InvoiceResponse {
        $params = Util::removeNulls(['invoiceID' => $invoiceID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($itemID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Add one or more line items to an existing invoice.
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
    ): InvoiceResponse {
        $params = Util::removeNulls(['items' => $items]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->add($invoiceID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
