<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Batches\BatchDeleteResponse;
use Vatsense\Batches\BatchListResponse;
use Vatsense\Batches\BatchResponse;
use Vatsense\Batches\BatchResultsResponse;
use Vatsense\Client;
use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\Core\Util;
use Vatsense\RequestOptions;

/**
 * Bulk validation: check many VAT numbers in one batch.
 *
 * Each method returns the raw response; call `parse()` on it for the model.
 *
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
final class BatchesRawService
{
    /** API names of the body and query parameters. */
    private const NAMES = [
        'autoContinue' => 'auto_continue',
        'idempotencyKey' => 'Idempotency-Key',
    ];

    /** API names of the keys of a row. */
    private const ROW_NAMES = [
        'vatNumber' => 'vat_number',
        'countryCode' => 'country_code',
        'companyName' => 'company_name',
        'addressLine2' => 'address_line_2',
    ];

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a batch and, by default, start it.
     *
     * @param array{
     *   numbers?: list<string>,
     *   rows?: list<array<string,string>>,
     *   reference?: string,
     *   start?: bool,
     *   shortfall?: string,
     *   autoContinue?: bool,
     *   consultation?: bool,
     *   idempotencyKey?: string,
     * } $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchResponse>
     *
     * @throws APIException
     */
    public function create(
        array $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        $body = Util::array_transform_keys(self::withoutNulls($params), self::NAMES);
        $headers = [];

        if (isset($body['Idempotency-Key'])) {
            $headers['Idempotency-Key'] = $body['Idempotency-Key'];
            unset($body['Idempotency-Key']);
        }

        if (isset($body['rows']) && is_array($body['rows'])) {
            $body['rows'] = array_map(
                static fn (mixed $row): mixed => is_array($row) ? Util::array_transform_keys($row, self::ROW_NAMES) : $row,
                $body['rows'],
            );
        }

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'batches',
            headers: $headers,
            body: (object) $body,
            options: $requestOptions,
            convert: BatchResponse::class,
        );
    }

    /**
     * @api
     *
     * The account's batches, newest first.
     *
     * @param array{page?: int, limit?: int, status?: string} $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchListResponse>
     *
     * @throws APIException
     */
    public function list(
        array $params = [],
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'batches',
            query: self::withoutNulls($params),
            options: $requestOptions,
            convert: BatchListResponse::class,
        );
    }

    /**
     * @api
     *
     * A batch and its progress.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $batchID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        return $this->action('get', $batchID, '', $requestOptions);
    }

    /**
     * @api
     *
     * Delete a draft.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $batchID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['batches/%1$s', $batchID],
            options: $requestOptions,
            convert: BatchDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Start a draft.
     *
     * @param array{shortfall?: string, autoContinue?: bool, consultation?: bool} $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchResponse>
     *
     * @throws APIException
     */
    public function start(
        string $batchID,
        array $params = [],
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        return $this->action('post', $batchID, '/start', $requestOptions, $params);
    }

    /**
     * @api
     *
     * Pause a running batch.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchResponse>
     *
     * @throws APIException
     */
    public function pause(
        string $batchID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        return $this->action('post', $batchID, '/pause', $requestOptions, []);
    }

    /**
     * @api
     *
     * Continue a paused batch.
     *
     * @param array{shortfall?: string} $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchResponse>
     *
     * @throws APIException
     */
    public function continue(
        string $batchID,
        array $params = [],
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        return $this->action('post', $batchID, '/continue', $requestOptions, $params);
    }

    /**
     * @api
     *
     * Mark a paused batch complete, leaving the rest unchecked.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchResponse>
     *
     * @throws APIException
     */
    public function complete(
        string $batchID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        return $this->action('post', $batchID, '/complete', $requestOptions, []);
    }

    /**
     * @api
     *
     * The batch's checked rows as JSON, in row order.
     *
     * @param array{after?: int, limit?: int} $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchResultsResponse>
     *
     * @throws APIException
     */
    public function results(
        string $batchID,
        array $params = [],
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['batches/%1$s/results', $batchID],
            query: self::withoutNulls($params),
            options: $requestOptions,
            convert: BatchResultsResponse::class,
        );
    }

    /**
     * @api
     *
     * The batch's CSV report. `parse()` gives the body in pieces; the service's
     * `resultsCsv()` joins them into one string.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function resultsCsv(
        string $batchID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['batches/%1$s/results.csv', $batchID],
            headers: ['Accept' => 'text/csv'],
            options: $requestOptions,
        );
    }

    /**
     * @param array<string,mixed>|null $params null for a call with no body
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BatchResponse>
     */
    private function action(
        string $method,
        string $batchID,
        string $suffix,
        RequestOptions|array|null $requestOptions,
        ?array $params = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: $method,
            path: ['batches/%1$s' . $suffix, $batchID],
            body: null === $params ? null : (object) Util::array_transform_keys(self::withoutNulls($params), self::NAMES),
            options: $requestOptions,
            convert: BatchResponse::class,
        );
    }

    /**
     * @param array<string,mixed> $params
     *
     * @return array<string,mixed>
     */
    private static function withoutNulls(array $params): array
    {
        return array_filter($params, static fn (mixed $value): bool => null !== $value);
    }
}
