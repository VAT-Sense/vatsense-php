<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Client;
use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Invoice\InvoiceBusinessInput;
use Vatsense\Invoice\InvoiceConversionInput;
use Vatsense\Invoice\InvoiceCreateParams;
use Vatsense\Invoice\InvoiceCreateParams\TaxType;
use Vatsense\Invoice\InvoiceCreateParams\Type;
use Vatsense\Invoice\InvoiceCustomerInput;
use Vatsense\Invoice\InvoiceDeleteResponse;
use Vatsense\Invoice\InvoiceListParams;
use Vatsense\Invoice\InvoiceListResponse;
use Vatsense\Invoice\InvoiceResponse;
use Vatsense\Invoice\InvoiceUpdateParams;
use Vatsense\Invoice\Item\InvoiceItemInput;
use Vatsense\RequestOptions;
use Vatsense\ServiceContracts\InvoiceRawContract;

/**
 * VAT-compliant invoice management.
 *
 * @phpstan-import-type InvoiceBusinessInputShape from \Vatsense\Invoice\InvoiceBusinessInput
 * @phpstan-import-type InvoiceItemInputShape from \Vatsense\Invoice\Item\InvoiceItemInput
 * @phpstan-import-type InvoiceConversionInputShape from \Vatsense\Invoice\InvoiceConversionInput
 * @phpstan-import-type InvoiceCustomerInputShape from \Vatsense\Invoice\InvoiceCustomerInput
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
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
