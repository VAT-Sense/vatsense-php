<?php

declare(strict_types=1);

namespace VatsenseVatsense\ServiceContracts;

use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\RequestOptions;
use VatsenseVatsense\Sandbox\SandboxGenerateKeyResponse;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
 */
interface SandboxContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function generateKey(
        RequestOptions|array|null $requestOptions = null
    ): SandboxGenerateKeyResponse;
}
