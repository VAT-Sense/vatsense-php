<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Services\Invoice;

use VatsenseVatsensePhp\Client;
use VatsenseVatsensePhp\Core\Contracts\BaseResponse;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Invoice\InvoiceResponse;
use VatsenseVatsensePhp\Invoice\Item\InvoiceItemInput;
use VatsenseVatsensePhp\Invoice\Item\ItemAddParams;
use VatsenseVatsensePhp\Invoice\Item\ItemDeleteParams;
use VatsenseVatsensePhp\Invoice\Item\ItemGetResponse;
use VatsenseVatsensePhp\Invoice\Item\ItemRetrieveParams;
use VatsenseVatsensePhp\Invoice\Item\ItemUpdateParams;
use VatsenseVatsensePhp\RequestOptions;
use VatsenseVatsensePhp\ServiceContracts\Invoice\ItemRawContract;

/**
 * VAT-compliant invoice management.
 *
 * @phpstan-import-type InvoiceItemInputShape from \VatsenseVatsensePhp\Invoice\Item\InvoiceItemInput
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
final class ItemRawService implements ItemRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a specific line item from an invoice.
     *
     * @param string $itemID the unique identifier of the invoice item
     * @param array{invoiceID: string}|ItemRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ItemGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $itemID,
        array|ItemRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ItemRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $invoiceID = $parsed['invoiceID'];
        unset($parsed['invoiceID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['invoice/%1$s/item/%2$s', $invoiceID, $itemID],
            options: $options,
            convert: ItemGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Update a specific line item on an invoice.
     *
     * @param string $itemID path param: The unique identifier of the invoice item
     * @param array{
     *   invoiceID: string,
     *   item: string,
     *   priceEach: float,
     *   quantity: float,
     *   vatRate: float,
     *   discountRate?: float,
     * }|ItemUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvoiceResponse>
     *
     * @throws APIException
     */
    public function update(
        string $itemID,
        array|ItemUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ItemUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $invoiceID = $parsed['invoiceID'];
        unset($parsed['invoiceID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['invoice/%1$s/item/%2$s', $invoiceID, $itemID],
            body: (object) array_diff_key($parsed, array_flip(['invoiceID'])),
            options: $options,
            convert: InvoiceResponse::class,
        );
    }

    /**
     * @api
     *
     * Remove a specific line item from an invoice.
     *
     * @param string $itemID the unique identifier of the invoice item
     * @param array{invoiceID: string}|ItemDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvoiceResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $itemID,
        array|ItemDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ItemDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $invoiceID = $parsed['invoiceID'];
        unset($parsed['invoiceID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['invoice/%1$s/item/%2$s', $invoiceID, $itemID],
            options: $options,
            convert: InvoiceResponse::class,
        );
    }

    /**
     * @api
     *
     * Add one or more line items to an existing invoice.
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param array{
     *   items: list<InvoiceItemInput|InvoiceItemInputShape>
     * }|ItemAddParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvoiceResponse>
     *
     * @throws APIException
     */
    public function add(
        string $invoiceID,
        array|ItemAddParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ItemAddParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['invoice/%1$s/item', $invoiceID],
            body: (object) $parsed,
            options: $options,
            convert: InvoiceResponse::class,
        );
    }
}
