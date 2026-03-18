<?php

declare(strict_types=1);

namespace Vatsense\ServiceContracts;

use Vatsense\Core\Exceptions\APIException;
use Vatsense\RequestOptions;
use Vatsense\Usage\UsageGetResponse;

/**
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
interface UsageContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): UsageGetResponse;
}
