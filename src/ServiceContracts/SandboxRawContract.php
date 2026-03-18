<?php

declare(strict_types=1);

namespace Vatsense\ServiceContracts;

use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\RequestOptions;
use Vatsense\Sandbox\SandboxGenerateKeyResponse;

/**
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
interface SandboxRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SandboxGenerateKeyResponse>
     *
     * @throws APIException
     */
    public function generateKey(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
