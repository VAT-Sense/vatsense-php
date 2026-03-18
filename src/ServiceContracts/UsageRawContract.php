<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\ServiceContracts;

use VatsenseVatsensePhp\Core\Contracts\BaseResponse;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\RequestOptions;
use VatsenseVatsensePhp\Usage\UsageGetResponse;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
 */
interface UsageRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UsageGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
