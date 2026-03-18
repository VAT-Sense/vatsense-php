<?php

declare(strict_types=1);

namespace VatsenseVatsense\Services;

use VatsenseVatsense\Client;
use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\RequestOptions;
use VatsenseVatsense\Sandbox\SandboxGenerateKeyResponse;
use VatsenseVatsense\ServiceContracts\SandboxContract;

/**
 * Temporary sandbox API keys for testing.
 *
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
 */
final class SandboxService implements SandboxContract
{
    /**
     * @api
     */
    public SandboxRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SandboxRawService($client);
    }

    /**
     * @api
     *
     * Generate a temporary sandbox API key for testing. Sandbox keys have
     * limited request allowances and restricted endpoint access (no invoice
     * endpoints). Rate limited to 1 key per IP address per 6 hours.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function generateKey(
        RequestOptions|array|null $requestOptions = null
    ): SandboxGenerateKeyResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->generateKey(requestOptions: $requestOptions);

        return $response->parse();
    }
}
