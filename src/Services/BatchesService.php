<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Batches\BatchDeleteResponse;
use Vatsense\Batches\BatchListResponse;
use Vatsense\Batches\BatchResponse;
use Vatsense\Batches\BatchResultsResponse;
use Vatsense\Client;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\RequestOptions;

/**
 * Bulk validation: check many VAT numbers in one batch.
 *
 * Batch calls are free and work even when your requests are used up; each
 * number a batch checks counts as one request. With a test key a batch is
 * answered from the test numbers, is free and holds at most 1,000 numbers.
 *
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
final class BatchesService
{
    /**
     * @api
     */
    public BatchesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BatchesRawService($client);
    }

    /**
     * @api
     *
     * Create a batch of VAT numbers and, by default, start checking it. Send
     * exactly one of `numbers` or `rows`.
     *
     * @param list<string>|null $numbers the VAT numbers to check, each with its 2-character country code
     * @param list<array<string,string>>|null $rows rows with `vatNumber` and, for company matching, any of
     * `countryCode`, `companyName`, `address`, `street`, `addressLine2`, `postcode` and `city`
     * @param string|null $reference your own label for the batch, at most 255 characters
     * @param bool|null $start defaults to true; false keeps a draft for 24 hours, to start with `start()`
     * @param string|null $shortfall when your requests do not cover the batch: `wait` (the default) starts
     * nothing and returns the `quote`, `pause` checks what is covered and pauses the rest, `overage` runs
     * into overage (it must already be on in the dashboard)
     * @param bool|null $autoContinue defaults to true; with `pause`, continue when your requests renew
     * @param bool|null $consultation defaults to false; send the requester VAT number from your account
     * settings with each check
     * @param string|null $idempotencyKey sent as the `Idempotency-Key` header, at most 64 characters; the
     * same key again returns the batch already made
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?array $numbers = null,
        ?array $rows = null,
        ?string $reference = null,
        ?bool $start = null,
        ?string $shortfall = null,
        ?bool $autoContinue = null,
        ?bool $consultation = null,
        ?string $idempotencyKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchResponse {
        $params = [
            'numbers' => $numbers,
            'rows' => $rows,
            'reference' => $reference,
            'start' => $start,
            'shortfall' => $shortfall,
            'autoContinue' => $autoContinue,
            'consultation' => $consultation,
            'idempotencyKey' => $idempotencyKey,
        ];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * The account's batches, newest first.
     *
     * @param int|null $page the page, from 1
     * @param int|null $limit batches a page, 1 to 100 (default 25)
     * @param string|null $status `draft` lists the drafts not yet started instead
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?int $page = null,
        ?int $limit = null,
        ?string $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(['page' => $page, 'limit' => $limit, 'status' => $status], $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * A batch and its progress. Poll until `status` is `complete`, or take the
     * `batch.completed` webhook.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $batchID,
        RequestOptions|array|null $requestOptions = null,
    ): BatchResponse {
        return $this->raw->retrieve($batchID, $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Delete a draft. A batch that has started cannot be deleted (409).
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $batchID,
        RequestOptions|array|null $requestOptions = null,
    ): BatchDeleteResponse {
        return $this->raw->delete($batchID, $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Start a draft, with the same options as `create()`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function start(
        string $batchID,
        ?string $shortfall = null,
        ?bool $autoContinue = null,
        ?bool $consultation = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchResponse {
        $params = ['shortfall' => $shortfall, 'autoContinue' => $autoContinue, 'consultation' => $consultation];

        // @phpstan-ignore-next-line argument.type
        return $this->raw->start($batchID, $params, $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Pause a running batch.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function pause(
        string $batchID,
        RequestOptions|array|null $requestOptions = null,
    ): BatchResponse {
        return $this->raw->pause($batchID, $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Continue a paused batch. Send `shortfall: 'overage'` to run into overage.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function continue(
        string $batchID,
        ?string $shortfall = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchResponse {
        // @phpstan-ignore-next-line argument.type
        return $this->raw->continue($batchID, ['shortfall' => $shortfall], $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Mark a paused batch complete, leaving the rest unchecked.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $batchID,
        RequestOptions|array|null $requestOptions = null,
    ): BatchResponse {
        return $this->raw->complete($batchID, $requestOptions)->parse();
    }

    /**
     * @api
     *
     * The batch's checked rows as JSON, in row order. Follow `nextAfter` while
     * `hasMore` is true.
     *
     * @param int|null $after return rows after this row number (default 0)
     * @param int|null $limit rows a page, 1 to 1,000 (default 100)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function results(
        string $batchID,
        ?int $after = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchResultsResponse {
        // @phpstan-ignore-next-line argument.type
        return $this->raw->results($batchID, ['after' => $after, 'limit' => $limit], $requestOptions)->parse();
    }

    /**
     * @api
     *
     * The batch's CSV report, the same file the dashboard gives.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function resultsCsv(
        string $batchID,
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $body = $this->raw->resultsCsv($batchID, $requestOptions)->parse();

        if (is_string($body)) {
            return $body;
        }

        $csv = '';

        if (is_iterable($body)) {
            foreach ($body as $piece) {
                $csv .= is_string($piece) ? $piece : '';
            }
        }

        return $csv;
    }
}
