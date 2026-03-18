<?php

declare(strict_types=1);

namespace Vatsense\Validate\ValidateCheckResponse\Data;

use Vatsense\Core\Concerns\SdkUnion;
use Vatsense\Core\Conversion\Contracts\Converter;
use Vatsense\Core\Conversion\Contracts\ConverterSource;
use Vatsense\Validate\ValidateCheckResponse\Data\Company\EoriValidationCompany;
use Vatsense\Validate\ValidateCheckResponse\Data\Company\ValidationCompany;

/**
 * @phpstan-import-type ValidationCompanyShape from \Vatsense\Validate\ValidateCheckResponse\Data\Company\ValidationCompany
 * @phpstan-import-type EoriValidationCompanyShape from \Vatsense\Validate\ValidateCheckResponse\Data\Company\EoriValidationCompany
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
