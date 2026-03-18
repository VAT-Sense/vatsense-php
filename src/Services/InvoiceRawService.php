<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Services;

use VatsenseVatsensePhp\Client;
use VatsenseVatsensePhp\Core\Contracts\BaseResponse;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Invoice\InvoiceBusinessInput;
use VatsenseVatsensePhp\Invoice\InvoiceConversionInput;
use VatsenseVatsensePhp\Invoice\InvoiceCreateParams;
use VatsenseVatsensePhp\Invoice\InvoiceCreateParams\TaxType;
use VatsenseVatsensePhp\Invoice\InvoiceCreateParams\Type;
use VatsenseVatsensePhp\Invoice\InvoiceCustomerInput;
use VatsenseVatsensePhp\Invoice\InvoiceDeleteResponse;
use VatsenseVatsensePhp\Invoice\InvoiceListParams;
use VatsenseVatsensePhp\Invoice\InvoiceListResponse;
use VatsenseVatsensePhp\Invoice\InvoiceResponse;
use VatsenseVatsensePhp\Invoice\InvoiceUpdateParams;
use VatsenseVatsensePhp\Invoice\Item\InvoiceItemInput;
use VatsenseVatsensePhp\RequestOptions;
use VatsenseVatsensePhp\ServiceContracts\InvoiceRawContract;

/**
 * VAT-compliant invoice management.
 *
 * @phpstan-import-type InvoiceBusinessInputShape from \VatsenseVatsensePhp\Invoice\InvoiceBusinessInput
 * @phpstan-import-type InvoiceItemInputShape from \VatsenseVatsensePhp\Invoice\Item\InvoiceItemInput
 * @phpstan-import-type InvoiceConversionInputShape from \VatsenseVatsensePhp\Invoice\InvoiceConversionInput
 * @phpstan-import-type InvoiceCustomerInputShape from \VatsenseVatsensePhp\Invoice\InvoiceCustomerInput
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
final class InvoiceRawService implements InvoiceRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new VAT-compliant invoice. VAT Sense will automatically
     * calculate the totals based on the items provided.
     *
     * Not available with sandbox API keys.
     *
     * @param array{
     *   business: InvoiceBusinessInput|InvoiceBusinessInputShape,
     *   currencyCode: string,
     *   date: string,
     *   items: list<InvoiceItemInput|InvoiceItemInputShape>,
     *   taxPoint: string,
     *   conversion?: InvoiceConversionInput|InvoiceConversionInputShape,
     *   customer?: InvoiceCustomerInput|InvoiceCustomerInputShape,
     *   hasVat?: bool,
     *   invoiceNumber?: string,
     *   isCopy?: bool,
     *   isReverseCharge?: bool,
     *   notes?: string,
     *   padInvoiceNumber?: int,
     *   serial?: string,
     *   taxType?: TaxType|value-of<TaxType>,
     *   type?: Type|value-of<Type>,
     *   zeroRated?: bool,
     * }|InvoiceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvoiceResponse>
     *
     * @throws APIException
     */
    public function create(
        array|InvoiceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvoiceCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'invoice',
            body: (object) $parsed,
            options: $options,
            convert: InvoiceResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a specific invoice by its ID.
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvoiceResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['invoice/%1$s', $invoiceID],
            options: $requestOptions,
            convert: InvoiceResponse::class,
        );
    }

    /**
     * @api
     *
     * Update an existing invoice. Only the fields provided will be updated.
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param array{
     *   business: InvoiceBusinessInput|InvoiceBusinessInputShape,
     *   currencyCode: string,
     *   date: string,
     *   items: list<InvoiceItemInput|InvoiceItemInputShape>,
     *   taxPoint: string,
     *   conversion?: InvoiceConversionInput|InvoiceConversionInputShape,
     *   customer?: InvoiceCustomerInput|InvoiceCustomerInputShape,
     *   hasVat?: bool,
     *   invoiceNumber?: string,
     *   isCopy?: bool,
     *   isReverseCharge?: bool,
     *   notes?: string,
     *   padInvoiceNumber?: int,
     *   serial?: string,
     *   taxType?: InvoiceUpdateParams\TaxType|value-of<InvoiceUpdateParams\TaxType>,
     *   type?: InvoiceUpdateParams\Type|value-of<InvoiceUpdateParams\Type>,
     *   zeroRated?: bool,
     * }|InvoiceUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvoiceResponse>
     *
     * @throws APIException
     */
    public function update(
        string $invoiceID,
        array|InvoiceUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvoiceUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['invoice/%1$s', $invoiceID],
            body: (object) $parsed,
            options: $options,
            convert: InvoiceResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a paginated list of all invoices.
     *
     * @param array{
     *   limit?: int, offset?: int, search?: string
     * }|InvoiceListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvoiceListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|InvoiceListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvoiceListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'invoice',
            query: $parsed,
            options: $options,
            convert: InvoiceListResponse::class,
        );
    }

    /**
     * @api
     *
     * Permanently delete an invoice.
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvoiceDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['invoice/%1$s', $invoiceID],
            options: $requestOptions,
            convert: InvoiceDeleteResponse::class,
        );
    }
}
