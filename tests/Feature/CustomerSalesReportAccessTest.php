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
        $this->withSession(['_token' => 'customer-sales-test-token'])
            ->post(route('reports.sales.customer_detail.data'), [
                '_token' => 'customer-sales-test-token',
            ])
            ->assertRedirect(route('login'));
    }

    public function test_report_export_requires_backend_login()
    {
        $this->get(route('reports.sales.customer_detail.export'))
            ->assertRedirect(route('login'));
    }
}
