<?php

namespace Tests\Feature;

use Tests\TestCase;

class CustomerSalesReportAccessTest extends TestCase
{
    public function test_report_page_requires_backend_login()
    {
        $this->get(route('reports.sales.customer_detail'))
            ->assertRedirect(route('login'));
    }

    public function test_report_data_requires_backend_login()
    {
        $this->get(route('reports.sales.analysis.details', [
                'dimension' => 'customer',
                'amount_basis' => 'pre_tax',
                'start_date' => '2026-01-01',
                'end_date' => '2026-01-31',
                'date_basis' => 'transaction',
                'order_status' => 'all',
                'sort_by' => 'transaction_date',
                'sort_direction' => 'desc',
            ]))
            ->assertRedirect(route('login'));
    }

    public function test_report_export_requires_backend_login()
    {
        $this->get(route('reports.sales.customer_detail.export'))
            ->assertRedirect(route('login'));
    }
}
