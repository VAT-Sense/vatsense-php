<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\ServiceContracts\Invoice;

use VatsenseVatsensePhp\Core\Contracts\BaseResponse;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Invoice\InvoiceResponse;
use VatsenseVatsensePhp\Invoice\Item\ItemAddParams;
use VatsenseVatsensePhp\Invoice\Item\ItemDeleteParams;
use VatsenseVatsensePhp\Invoice\Item\ItemGetResponse;
use VatsenseVatsensePhp\Invoice\Item\ItemRetrieveParams;
use VatsenseVatsensePhp\Invoice\Item\ItemUpdateParams;
use VatsenseVatsensePhp\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
interface ItemRawContract
{
    /**
     * @api
     *
     * @param string $itemID the unique identifier of the invoice item
     * @param array<string,mixed>|ItemRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $itemID path param: The unique identifier of the invoice item
     * @param array<string,mixed>|ItemUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $itemID the unique identifier of the invoice item
     * @param array<string,mixed>|ItemDeleteParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param array<string,mixed>|ItemAddParams $params
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
    ): BaseResponse;
}
