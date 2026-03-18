<?php

declare(strict_types=1);

namespace Vatsense\Services;

use Vatsense\Client;
use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\RequestOptions;
use Vatsense\ServiceContracts\UsageRawContract;
use Vatsense\Usage\UsageGetResponse;

/**
 * API usage statistics.
 *
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
final class UsageRawService implements UsageRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Check your used and remaining API requests.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UsageGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'usage',
            options: $requestOptions,
            convert: UsageGetResponse::class,
        );
    }
}
