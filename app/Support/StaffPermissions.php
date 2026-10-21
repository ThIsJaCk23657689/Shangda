<?php

namespace App\Support;

use App\Enums\PrivilegedJobTitle;
use App\Enums\StaffPermission;
use App\User;

final class StaffPermissions
{
    /** @return list<string> */
    public static function for(?User $user): array
    {
        if ($user === null || ! PrivilegedJobTitle::contains($user->job_title_id)) {
            return [];
        }

        return array_column(StaffPermission::cases(), 'value');
    }

    public static function allows(?User $user, StaffPermission $permission): bool
    {
        return in_array($permission->value, self::for($user), true);
    }
}
