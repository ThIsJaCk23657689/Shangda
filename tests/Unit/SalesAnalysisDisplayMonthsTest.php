<?php

namespace Tests\Unit;

use App\Services\SalesAnalysisService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ReflectionMethod;
use Tests\TestCase;

class SalesAnalysisDisplayMonthsTest extends TestCase
{
    public function test_current_year_stops_at_current_month_and_history_keeps_twelve_months()
    {
        Carbon::setTestNow(Carbon::parse('2026-08-02 12:00:00', 'Asia/Taipei'));

        try {
            $method = new ReflectionMethod(SalesAnalysisService::class, 'displayMonthsForYear');
            $method->setAccessible(true);
            $service = app(SalesAnalysisService::class);

            $this->assertSame(range(1, 8), $method->invoke($service, 2026));
            $this->assertSame(range(1, 12), $method->invoke($service, 2025));
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_overview_period_modes_are_normalized_to_the_visible_months()
    {
        Carbon::setTestNow(Carbon::parse('2026-08-02 12:00:00', 'Asia/Taipei'));

        try {
            $method = new ReflectionMethod(SalesAnalysisService::class, 'overviewPeriod');
            $method->setAccessible(true);
            $service = app(SalesAnalysisService::class);

            $year = $method->invoke($service, new Request(['period_mode' => 'year', 'year' => 2026]));
            $month = $method->invoke($service, new Request(['period_mode' => 'month', 'year' => 2026, 'month' => 5]));
            $range = $method->invoke($service, new Request(['period_mode' => 'range', 'year' => 2025, 'start_month' => 3, 'end_month' => 6]));

            $this->assertSame(range(1, 8), $year['months']);
            $this->assertSame('2026', $year['file_token']);
            $this->assertSame([5], $month['months']);
            $this->assertSame('2026-05', $month['file_token']);
            $this->assertSame(range(3, 6), $range['months']);
            $this->assertSame('2025-03_2025-06', $range['file_token']);
            $this->assertSame('2025-03-01 00:00:00', $range['start']);
            $this->assertSame('2025-06-30 23:59:59', $range['end']);
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_overview_export_uses_only_the_visible_month_headers_and_builds_three_month_pdf_sections()
    {
        $service = \Mockery::mock(SalesAnalysisService::class)->makePartial();
        $service->shouldReceive('overview')->once()->andReturn([
            'display_months' => [3, 4, 5, 6],
            'total_label' => '區間總計',
            'period' => ['label' => '2025 年 3 月至 6 月'],
            'rows' => [[
                'entity' => ['name' => '測試顧客'],
                'months' => [0, 0, 30, 40, 50, 60, 0, 0, 0, 0, 0, 0],
                'total' => 180.0,
            ]],
            'chart' => [],
        ]);
        $request = new Request(['tab' => 'overview']);

        $table = $service->exportTable($request);

        $this->assertSame(['實體名稱', '3月', '4月', '5月', '6月', '區間總計'], $table['headers']);
        $this->assertSame(['測試顧客', 30, 40, 50, 60, 180.0], $table['rows'][0]);
        $this->assertCount(2, $table['sections']);
        $this->assertSame([3, 4, 5], $table['sections'][0]['months']);
        $this->assertSame([6], $table['sections'][1]['months']);
    }
}
