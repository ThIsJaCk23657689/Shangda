<?php

namespace Tests\Unit;

use App\Services\SalesAnalysisService;
use Carbon\Carbon;
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
}
