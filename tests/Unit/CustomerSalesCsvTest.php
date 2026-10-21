<?php

namespace Tests\Unit;

use App\Http\Controllers\ReportController;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CustomerSalesCsvTest extends TestCase
{
    #[DataProvider('dangerousCsvValues')]
    public function test_it_escapes_text_that_excel_could_execute($value)
    {
        $controller = new ReportController();

        $this->assertSame("'" . $value, $controller->escapeCsvValue($value));
    }

    public static function dangerousCsvValues(): array
    {
        return [
            ['=SUM(A1:A2)'],
            ['+cmd'],
            ['-cmd'],
            ['@cmd'],
        ];
    }

    public function test_it_does_not_change_numeric_negative_amounts()
    {
        $controller = new ReportController();

        $this->assertSame(-1200.5, $controller->escapeCsvValue(-1200.5));
    }
}
