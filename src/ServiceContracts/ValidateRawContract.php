<?php

declare(strict_types=1);

namespace VatsenseVatsense\ServiceContracts;

use VatsenseVatsense\Core\Contracts\BaseResponse;
use VatsenseVatsense\Core\Exceptions\APIException;
use VatsenseVatsense\RequestOptions;
use VatsenseVatsense\Validate\ValidateCheckParams;
use VatsenseVatsense\Validate\ValidateCheckResponse;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsense\RequestOptions
 */
interface ValidateRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ValidateCheckParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ValidateCheckResponse>
     *
     * @throws APIException
     */
    public function check(
        array|ValidateCheckParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
