<?php

declare(strict_types=1);

namespace Vatsense\ServiceContracts;

use Vatsense\Core\Contracts\BaseResponse;
use Vatsense\Core\Exceptions\APIException;
use Vatsense\RequestOptions;
use Vatsense\Validate\ValidateCheckParams;
use Vatsense\Validate\ValidateCheckResponse;

/**
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
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
