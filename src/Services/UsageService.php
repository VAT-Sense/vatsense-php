<?php

declare(strict_types=1);

namespace VatsenseVatsense\Services;

use VatsenseVatsense\Client;
use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\RequestOptions;
use VatsenseVatsense\ServiceContracts\UsageContract;
use VatsenseVatsense\Usage\UsageGetResponse;

/**
 * API usage statistics.
 *
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
 */
final class UsageService implements UsageContract
{
    /**
     * @api
     */
    public UsageRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UsageRawService($client);
    }

    /**
     * @api
     *
     * Check your used and remaining API requests.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): UsageGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(requestOptions: $requestOptions);

        return $response->parse();
    }
}
