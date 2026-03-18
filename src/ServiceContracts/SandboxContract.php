<?php

declare(strict_types=1);

namespace Vatsense\ServiceContracts;

use Vatsense\Core\Exceptions\APIException;
use Vatsense\RequestOptions;
use Vatsense\Sandbox\SandboxGenerateKeyResponse;

/**
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
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
