<?php

namespace App\Enums;

enum PrivilegedJobTitle: int
{
    case Administrator = 3;
    case SuperAdministrator = 4;

    public static function contains(?int $jobTitleId): bool
    {
        return $jobTitleId !== null && in_array(
            $jobTitleId,
            array_column(self::cases(), 'value'),
            true,
        );
    }
}
