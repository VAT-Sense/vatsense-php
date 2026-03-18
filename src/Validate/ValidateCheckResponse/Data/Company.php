<?php

declare(strict_types=1);

namespace VatsenseVatsensePhp\Validate\ValidateCheckResponse\Data;

use VatsenseVatsensePhp\Core\Concerns\SdkUnion;
use VatsenseVatsensePhp\Core\Conversion\Contracts\Converter;
use VatsenseVatsensePhp\Core\Conversion\Contracts\ConverterSource;
use VatsenseVatsensePhp\Validate\ValidateCheckResponse\Data\Company\EoriValidationCompany;
use VatsenseVatsensePhp\Validate\ValidateCheckResponse\Data\Company\ValidationCompany;

/**
 * @phpstan-import-type ValidationCompanyShape from \VatsenseVatsensePhp\Validate\ValidateCheckResponse\Data\Company\ValidationCompany
 * @phpstan-import-type EoriValidationCompanyShape from \VatsenseVatsensePhp\Validate\ValidateCheckResponse\Data\Company\EoriValidationCompany
 *
 * @phpstan-type CompanyVariants = ValidationCompany|EoriValidationCompany
 * @phpstan-type CompanyShape = CompanyVariants|ValidationCompanyShape|EoriValidationCompanyShape
 */
final class Company implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [ValidationCompany::class, EoriValidationCompany::class];
    }
}
