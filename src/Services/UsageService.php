<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Client;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\RequestOptions;
use Vatsense\ServiceContracts\UsageContract;
use Vatsense\Usage\UsageGetResponse;

/**
 * API usage statistics.
 *
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
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
