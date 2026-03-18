<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\ServiceContracts;

use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\RequestOptions;
use VatsenseVatsensePhp\Sandbox\SandboxGenerateKeyResponse;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
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
