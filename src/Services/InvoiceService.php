<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Services;

use VatsenseVatsensePhp\Client;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\Core\Util;
use VatsenseVatsensePhp\Invoice\InvoiceBusinessInput;
use VatsenseVatsensePhp\Invoice\InvoiceConversionInput;
use VatsenseVatsensePhp\Invoice\InvoiceCreateParams\TaxType;
use VatsenseVatsensePhp\Invoice\InvoiceCreateParams\Type;
use VatsenseVatsensePhp\Invoice\InvoiceCustomerInput;
use VatsenseVatsensePhp\Invoice\InvoiceDeleteResponse;
use VatsenseVatsensePhp\Invoice\InvoiceListResponse;
use VatsenseVatsensePhp\Invoice\InvoiceResponse;
use VatsenseVatsensePhp\Invoice\Item\InvoiceItemInput;
use VatsenseVatsensePhp\RequestOptions;
use VatsenseVatsensePhp\ServiceContracts\InvoiceContract;
use VatsenseVatsensePhp\Services\Invoice\ItemService;

/**
 * VAT-compliant invoice management.
 *
 * @phpstan-import-type InvoiceBusinessInputShape from \VatsenseVatsensePhp\Invoice\InvoiceBusinessInput
 * @phpstan-import-type InvoiceItemInputShape from \VatsenseVatsensePhp\Invoice\Item\InvoiceItemInput
 * @phpstan-import-type InvoiceConversionInputShape from \VatsenseVatsensePhp\Invoice\InvoiceConversionInput
 * @phpstan-import-type InvoiceCustomerInputShape from \VatsenseVatsensePhp\Invoice\InvoiceCustomerInput
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
final class InvoiceService implements InvoiceContract
{
    /**
     * @api
     */
    public InvoiceRawService $raw;

    /**
     * @api
     */
    public ItemService $item;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InvoiceRawService($client);
        $this->item = new ItemService($client);
    }

    /**
     * @api
     *
     * Create a new VAT-compliant invoice. VAT Sense will automatically
     * calculate the totals based on the items provided.
     *
     * Not available with sandbox API keys.
     *
     * @param InvoiceBusinessInput|InvoiceBusinessInputShape $business
     * @param string $currencyCode the 3-character currency code the invoice is billed in
     * @param string $date the date the invoice was issued (YYYY-MM-DD or YYYY-MM-DD HH:MM:SS)
     * @param list<InvoiceItemInput|InvoiceItemInputShape> $items
     * @param string $taxPoint the tax point or "time of supply" (YYYY-MM-DD or YYYY-MM-DD HH:MM:SS)
     * @param InvoiceConversionInput|InvoiceConversionInputShape $conversion
     * @param InvoiceCustomerInput|InvoiceCustomerInputShape $customer
     * @param bool $hasVat whether the invoice is subject to VAT
     * @param string $invoiceNumber A unique invoice number. If not provided, defaults to an auto-incremented number.
     * @param bool $isCopy whether the invoice is a copy of a primary invoice
     * @param bool $isReverseCharge whether the invoice is zero-rated due to reverse charge
     * @param string $notes any additional notes for the invoice
     * @param int $padInvoiceNumber pad the auto-generated invoice number with leading zeros to this length
     * @param string $serial A serial prepended to the auto-generated invoice number. Each unique serial has its own auto-increment range.
     * @param TaxType|value-of<TaxType> $taxType whether item prices include or exclude VAT
     * @param Type|value-of<Type> $type the type of invoice
     * @param bool $zeroRated whether the invoice has been zero-rated
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        InvoiceBusinessInput|array $business,
        string $currencyCode,
        string $date,
        array $items,
        string $taxPoint,
        InvoiceConversionInput|array|null $conversion = null,
        InvoiceCustomerInput|array|null $customer = null,
        ?bool $hasVat = null,
        ?string $invoiceNumber = null,
        bool $isCopy = false,
        bool $isReverseCharge = false,
        ?string $notes = null,
        ?int $padInvoiceNumber = null,
        ?string $serial = null,
        TaxType|string $taxType = 'incl',
        Type|string $type = 'sale',
        bool $zeroRated = false,
        RequestOptions|array|null $requestOptions = null,
    ): InvoiceResponse {
        $params = Util::removeNulls(
            [
                'business' => $business,
                'currencyCode' => $currencyCode,
                'date' => $date,
                'items' => $items,
                'taxPoint' => $taxPoint,
                'conversion' => $conversion,
                'customer' => $customer,
                'hasVat' => $hasVat,
                'invoiceNumber' => $invoiceNumber,
                'isCopy' => $isCopy,
                'isReverseCharge' => $isReverseCharge,
                'notes' => $notes,
                'padInvoiceNumber' => $padInvoiceNumber,
                'serial' => $serial,
                'taxType' => $taxType,
                'type' => $type,
                'zeroRated' => $zeroRated,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a specific invoice by its ID.
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): InvoiceResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($invoiceID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update an existing invoice. Only the fields provided will be updated.
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param InvoiceBusinessInput|InvoiceBusinessInputShape $business
     * @param string $currencyCode the 3-character currency code the invoice is billed in
     * @param string $date the date the invoice was issued (YYYY-MM-DD or YYYY-MM-DD HH:MM:SS)
     * @param list<InvoiceItemInput|InvoiceItemInputShape> $items
     * @param string $taxPoint the tax point or "time of supply" (YYYY-MM-DD or YYYY-MM-DD HH:MM:SS)
     * @param InvoiceConversionInput|InvoiceConversionInputShape $conversion
     * @param InvoiceCustomerInput|InvoiceCustomerInputShape $customer
     * @param bool $hasVat whether the invoice is subject to VAT
     * @param string $invoiceNumber A unique invoice number. If not provided, defaults to an auto-incremented number.
     * @param bool $isCopy whether the invoice is a copy of a primary invoice
     * @param bool $isReverseCharge whether the invoice is zero-rated due to reverse charge
     * @param string $notes any additional notes for the invoice
     * @param int $padInvoiceNumber pad the auto-generated invoice number with leading zeros to this length
     * @param string $serial A serial prepended to the auto-generated invoice number. Each unique serial has its own auto-increment range.
     * @param \VatsenseVatsensePhp\Invoice\InvoiceUpdateParams\TaxType|value-of<\VatsenseVatsensePhp\Invoice\InvoiceUpdateParams\TaxType> $taxType whether item prices include or exclude VAT
     * @param \VatsenseVatsensePhp\Invoice\InvoiceUpdateParams\Type|value-of<\VatsenseVatsensePhp\Invoice\InvoiceUpdateParams\Type> $type the type of invoice
     * @param bool $zeroRated whether the invoice has been zero-rated
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $invoiceID,
        InvoiceBusinessInput|array $business,
        string $currencyCode,
        string $date,
        array $items,
        string $taxPoint,
        InvoiceConversionInput|array|null $conversion = null,
        InvoiceCustomerInput|array|null $customer = null,
        ?bool $hasVat = null,
        ?string $invoiceNumber = null,
        bool $isCopy = false,
        bool $isReverseCharge = false,
        ?string $notes = null,
        ?int $padInvoiceNumber = null,
        ?string $serial = null,
        \VatsenseVatsensePhp\Invoice\InvoiceUpdateParams\TaxType|string $taxType = 'incl',
        \VatsenseVatsensePhp\Invoice\InvoiceUpdateParams\Type|string $type = 'sale',
        bool $zeroRated = false,
        RequestOptions|array|null $requestOptions = null,
    ): InvoiceResponse {
        $params = Util::removeNulls(
            [
                'business' => $business,
                'currencyCode' => $currencyCode,
                'date' => $date,
                'items' => $items,
                'taxPoint' => $taxPoint,
                'conversion' => $conversion,
                'customer' => $customer,
                'hasVat' => $hasVat,
                'invoiceNumber' => $invoiceNumber,
                'isCopy' => $isCopy,
                'isReverseCharge' => $isReverseCharge,
                'notes' => $notes,
                'padInvoiceNumber' => $padInvoiceNumber,
                'serial' => $serial,
                'taxType' => $taxType,
                'type' => $type,
                'zeroRated' => $zeroRated,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($invoiceID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of all invoices.
     *
     * @param int $limit number of invoices to return (default 10, max 100)
     * @param int $offset number of invoices to skip (default 0)
     * @param string $search search query to filter invoices
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        int $limit = 10,
        int $offset = 0,
        ?string $search = null,
        RequestOptions|array|null $requestOptions = null,
    ): InvoiceListResponse {
        $params = Util::removeNulls(
            ['limit' => $limit, 'offset' => $offset, 'search' => $search]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Permanently delete an invoice.
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): InvoiceDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($invoiceID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
