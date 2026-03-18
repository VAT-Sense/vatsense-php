<?php

declare(strict_types=1);

namespace VatsenseVatsense\Services;

use VatsenseVatsense\Client;
use VatsenseVatsense\Core\Contracts\BaseResponse;
use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\RequestOptions;
use VatsenseVatsense\Sandbox\SandboxGenerateKeyResponse;
use VatsenseVatsense\ServiceContracts\SandboxRawContract;

/**
 * Temporary sandbox API keys for testing.
 *
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
 */
final class SandboxRawService implements SandboxRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Generate a temporary sandbox API key for testing. Sandbox keys have
     * limited request allowances and restricted endpoint access (no invoice
     * endpoints). Rate limited to 1 key per IP address per 6 hours.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SandboxGenerateKeyResponse>
     *
     * @throws APIException
     */
    public function generateKey(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'sandbox/key',
            options: $requestOptions,
            convert: SandboxGenerateKeyResponse::class,
            security: [],
        );
    }
}
