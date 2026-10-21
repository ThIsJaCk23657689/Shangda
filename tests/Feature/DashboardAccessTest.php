<?php

namespace Tests\Feature;

use App\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class DashboardAccessTest extends TestCase
{
    public function test_dashboard_requires_login()
    {
        $this->get(route('backend'))->assertRedirect(route('login'));
    }

    #[DataProvider('unauthorizedJobTitles')]
    public function test_dashboard_rejects_non_management_users($jobTitleId)
    {
        $user = new User(['job_title_id' => $jobTitleId]);
        $user->id = 990000 + $jobTitleId;

        $this->actingAs($user)->get(route('backend'))->assertForbidden();
    }

    public static function unauthorizedJobTitles(): array
    {
        return [[1], [2]];
    }

    #[DataProvider('authorizedJobTitles')]
    public function test_management_users_can_view_real_dashboard($jobTitleId)
    {
        $user = new User(['job_title_id' => $jobTitleId]);
        $user->id = 991000 + $jobTitleId;

        $this->actingAs($user)
            ->get(route('backend'))
            ->assertOk()
            ->assertSee('經營管理 Dashboard')
            ->assertSee('本月營收')
            ->assertSee('應收帳款餘額')
            ->assertSee('逾期應收')
            ->assertSee('原物料低庫存')
            ->assertSee('近 12 個月營收趨勢')
            ->assertSee('本月 Top 5 顧客')
            ->assertSee('原物料庫存水位')
            ->assertDontSee('New Messages')
            ->assertDontSee('New Tasks')
            ->assertDontSee('New Tickets')
            ->assertDontSee('稼動率')
            ->assertDontSee('良率');
    }

    public static function authorizedJobTitles(): array
    {
        return [[3], [4]];
    }
}
