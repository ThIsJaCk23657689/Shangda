<?php

namespace Tests\Unit;

use App\Enums\StaffPermission;
use App\Support\StaffPermissions;
use App\User;
use PHPUnit\Framework\TestCase;

class StaffPermissionsTest extends TestCase
{
    public function test_management_job_titles_keep_all_existing_permissions(): void
    {
        foreach ([3, 4] as $jobTitleId) {
            $user = new User(['job_title_id' => $jobTitleId]);
            $this->assertTrue(StaffPermissions::allows($user, StaffPermission::AccessBackend));
            $this->assertCount(count(StaffPermission::cases()), StaffPermissions::for($user));
        }
    }

    public function test_other_job_titles_have_no_management_permissions(): void
    {
        foreach ([1, 2] as $jobTitleId) {
            $user = new User(['job_title_id' => $jobTitleId]);
            $this->assertSame([], StaffPermissions::for($user));
        }
    }
}
