<?php

namespace Tests\Unit;

use App\Http\Controllers\SalesAnalysisController;
use App\Services\SalesAnalysisService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ReflectionMethod;
use Tests\TestCase;

class SalesAnalysisPeriodValidationTest extends TestCase
{
    public function test_overview_accepts_year_month_and_range_modes()
    {
        Carbon::setTestNow(Carbon::parse('2026-08-02 12:00:00', 'Asia/Taipei'));

        try {
            $this->validateOverview(['period_mode' => 'year', 'year' => 2026]);
            $this->validateOverview(['period_mode' => 'month', 'year' => 2026, 'month' => 8]);
            $this->validateOverview(['period_mode' => 'range', 'year' => 2026, 'start_month' => 3, 'end_month' => 8]);
            $this->addToAssertionCount(3);
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_overview_rejects_future_month_and_reversed_range()
    {
        Carbon::setTestNow(Carbon::parse('2026-08-02 12:00:00', 'Asia/Taipei'));

        try {
            try {
                $this->validateOverview(['period_mode' => 'month', 'year' => 2026, 'month' => 9]);
                $this->fail('Future month should be rejected.');
            } catch (ValidationException $exception) {
                $this->assertArrayHasKey('end_month', $exception->errors());
            }

            try {
                $this->validateOverview(['period_mode' => 'range', 'year' => 2025, 'start_month' => 8, 'end_month' => 3]);
                $this->fail('Reversed range should be rejected.');
            } catch (ValidationException $exception) {
                $this->assertArrayHasKey('end_month', $exception->errors());
            }
        } finally {
            Carbon::setTestNow();
        }
    }

    private function validateOverview(array $parameters)
    {
        $request = Request::create('/reports/sales/analysis/overview', 'GET', array_merge([
            'dimension' => 'customer',
            'amount_basis' => 'pre_tax',
            'sort' => 'desc',
            'exclude_zero' => 1,
        ], $parameters));
        $controller = new SalesAnalysisController(app(SalesAnalysisService::class));
        $method = new ReflectionMethod(SalesAnalysisController::class, 'validateOverview');
        $method->setAccessible(true);
        $method->invoke($controller, $request);
    }
}
