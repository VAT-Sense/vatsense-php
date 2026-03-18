<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\ServiceContracts;

use VatsenseVatsensePhp\Core\Contracts\BaseResponse;
use VatsenseVatsensePhp\Core\Exceptions\APIException;
use VatsenseVatsensePhp\RequestOptions;
use VatsenseVatsensePhp\Validate\ValidateCheckParams;
use VatsenseVatsensePhp\Validate\ValidateCheckResponse;

/**
 * @phpstan-import-type RequestOpts from \VatsenseVatsensePhp\RequestOptions
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
