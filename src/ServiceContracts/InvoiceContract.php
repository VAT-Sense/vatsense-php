<?php

declare(strict_types=1);

namespace VatsenseVatsense\ServiceContracts;

use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\Invoice\InvoiceBusinessInput;
use VatsenseVatsense\Invoice\InvoiceConversionInput;
use VatsenseVatsense\Invoice\InvoiceCreateParams\TaxType;
use VatsenseVatsense\Invoice\InvoiceCreateParams\Type;
use VatsenseVatsense\Invoice\InvoiceCustomerInput;
use VatsenseVatsense\Invoice\InvoiceDeleteResponse;
use VatsenseVatsense\Invoice\InvoiceListResponse;
use VatsenseVatsense\Invoice\InvoiceResponse;
use VatsenseVatsense\Invoice\Item\InvoiceItemInput;
use VatsenseVatsense\RequestOptions;

/**
 * @phpstan-import-type InvoiceBusinessInputShape from \VatsenseVatsense\Invoice\InvoiceBusinessInput
 * @phpstan-import-type InvoiceItemInputShape from \VatsenseVatsense\Invoice\Item\InvoiceItemInput
 * @phpstan-import-type InvoiceConversionInputShape from \VatsenseVatsense\Invoice\InvoiceConversionInput
 * @phpstan-import-type InvoiceCustomerInputShape from \VatsenseVatsense\Invoice\InvoiceCustomerInput
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
 */
interface InvoiceContract
{
    /**
     * @api
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
    ): InvoiceResponse;

    /**
     * @api
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): InvoiceResponse;

    /**
     * @api
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
     * @param \VatsenseVatsense\Invoice\InvoiceUpdateParams\TaxType|value-of<\VatsenseVatsense\Invoice\InvoiceUpdateParams\TaxType> $taxType whether item prices include or exclude VAT
     * @param \VatsenseVatsense\Invoice\InvoiceUpdateParams\Type|value-of<\VatsenseVatsense\Invoice\InvoiceUpdateParams\Type> $type the type of invoice
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
        \VatsenseVatsense\Invoice\InvoiceUpdateParams\TaxType|string $taxType = 'incl',
        \VatsenseVatsense\Invoice\InvoiceUpdateParams\Type|string $type = 'sale',
        bool $zeroRated = false,
        RequestOptions|array|null $requestOptions = null,
    ): InvoiceResponse;

    /**
     * @api
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
    ): InvoiceListResponse;

    /**
     * @api
     *
     * @param string $invoiceID the unique identifier of the invoice
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): InvoiceDeleteResponse;
}
