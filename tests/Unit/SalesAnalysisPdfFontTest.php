<?php

namespace Tests\Unit;

use App\Http\Controllers\SalesAnalysisController;
use App\Services\SalesAnalysisService;
use ReflectionMethod;
use RuntimeException;
use Tests\TestCase;

class SalesAnalysisPdfFontTest extends TestCase
{
    public function test_pdf_embeds_static_regular_and_bold_traditional_chinese_fonts()
    {
        $pdf = \PDF::loadView('reports.sales.analysis_pdf', [
            'title' => '銷售分析繁中測試',
            'headers' => ['顧客名稱', '商品名稱'],
            'rows' => [['尚達測試顧客', '繁體中文商品']],
            'chartImage' => null,
            'filters' => ['amount_basis' => 'pre_tax'],
            'generatedAt' => now(),
        ]);

        $this->registrationMethod()->invoke($this->controller(), $pdf);
        $bytes = $pdf->output();

        $this->assertStringContainsString('NotoSansTC-Regular', $bytes);
        $this->assertStringContainsString('NotoSansTC-Bold', $bytes);
    }

    public function test_missing_pdf_font_raises_clear_error()
    {
        config(['dompdf.sales_analysis_fonts.normal' => resource_path('fonts/missing.ttf')]);
        $pdf = \PDF::loadHTML('<p>測試</p>');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('PDF 繁中字型檔遺失');
        $this->registrationMethod()->invoke($this->controller(), $pdf);
    }

    private function controller()
    {
        return new SalesAnalysisController(app(SalesAnalysisService::class));
    }

    private function registrationMethod()
    {
        $method = new ReflectionMethod(SalesAnalysisController::class, 'registerTraditionalChineseFonts');
        $method->setAccessible(true);
        return $method;
    }
}
