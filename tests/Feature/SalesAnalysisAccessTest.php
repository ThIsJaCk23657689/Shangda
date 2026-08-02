<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class SalesAnalysisAccessTest extends TestCase
{
    /** @dataProvider protectedRoutes */
    public function test_analysis_routes_require_login($method, $route)
    {
        $response = $method === 'post'
            ? $this->withSession(['_token' => 'sales-analysis-test-token'])
                ->post(route($route), ['_token' => 'sales-analysis-test-token'])
            : $this->get(route($route));

        $response->assertRedirect(route('login'));
    }

    public function protectedRoutes()
    {
        return [
            ['get', 'reports.sales.analysis'],
            ['get', 'reports.sales.analysis.meta'],
            ['get', 'reports.sales.analysis.entities'],
            ['get', 'reports.sales.analysis.overview'],
            ['get', 'reports.sales.analysis.drilldown'],
            ['get', 'reports.sales.analysis.details'],
            ['get', 'reports.sales.analysis.export.csv'],
            ['post', 'reports.sales.analysis.export.pdf'],
        ];
    }

    public function test_authorized_report_user_can_render_analysis_page()
    {
        $user = new User(['job_title_id' => 3]);
        $user->id = 999999;

        $this->actingAs($user)
            ->get(route('reports.sales.analysis'))
            ->assertOk()
            ->assertSee('sales-analysis');
    }

    /** @dataProvider legacyRoutes */
    public function test_legacy_report_pages_redirect_to_analysis($legacyRoute)
    {
        $user = new User(['job_title_id' => 4]);
        $user->id = 999998;

        $response = $this->actingAs($user)->get(route($legacyRoute));
        $response->assertStatus(302);
        $this->assertStringStartsWith(
            route('reports.sales.analysis'),
            $response->headers->get('Location')
        );
    }

    public function legacyRoutes()
    {
        return [
            ['reports.sales.year'],
            ['reports.sales.month'],
            ['reports.sales.daily'],
            ['reports.sales.customer_detail'],
        ];
    }
}
