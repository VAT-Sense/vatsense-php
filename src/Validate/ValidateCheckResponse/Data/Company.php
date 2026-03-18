<?php

declare(strict_types=1);

namespace VatsenseVatsense\Validate\ValidateCheckResponse\Data;

use VatsenseVatsense\Core\Concerns\SdkUnion;
use VatsenseVatsense\Core\Conversion\Contracts\Converter;
use VatsenseVatsense\Core\Conversion\Contracts\ConverterSource;
use VatsenseVatsense\Validate\ValidateCheckResponse\Data\Company\EoriValidationCompany;
use VatsenseVatsense\Validate\ValidateCheckResponse\Data\Company\ValidationCompany;

/**
 * @phpstan-import-type ValidationCompanyShape from \VatsenseVatsense\Validate\ValidateCheckResponse\Data\Company\ValidationCompany
 * @phpstan-import-type EoriValidationCompanyShape from \VatsenseVatsense\Validate\ValidateCheckResponse\Data\Company\EoriValidationCompany
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
