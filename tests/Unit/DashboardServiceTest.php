<?php

namespace Tests\Unit;

use App\Services\DashboardService;
use App\Services\SalesAnalysisService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DashboardServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $userId;
    private $productId;
    private $sequence = 0;

    protected function setUp(): void
    {
        parent::setUp();

        $token = uniqid('dashboard_test_', true);
        $this->userId = DB::table('users')->insertGetId([
            'job_title_id' => 4,
            'name' => 'Dashboard Test User',
            'email' => $token . '@example.test',
            'account' => substr(str_replace('.', '', $token), 0, 30),
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->productId = DB::table('products')->insertGetId([
            'category_id' => 1,
            'shownID' => strtoupper(substr(md5($token), 0, 16)),
            'name' => 'Dashboard Test Product',
            'unit' => 'package',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_sales_summary_uses_confirmed_net_sales_and_fills_twelve_months()
    {
        $customer = $this->createConsumer('主要顧客');
        $ignoredCustomer = $this->createConsumer('未核准顧客');

        $this->createOrder($customer, '2031-03-05 10:00:00', 1, 1, 100);
        $this->createOrder($customer, '2031-03-08 10:00:00', 2, 1, 20);
        $this->createOrder($ignoredCustomer, '2031-03-09 10:00:00', 1, 0, 999);
        $this->createOrder($customer, '2030-03-05 10:00:00', 1, 1, 40);

        $summary = app(SalesAnalysisService::class)->dashboardSalesSummary(
            Carbon::create(2031, 3, 15, 12, 0, 0, 'Asia/Taipei')
        );

        $this->assertSame(80.0, $summary['current_month']);
        $this->assertSame(40.0, $summary['previous_year_month']);
        $this->assertSame(100.0, $summary['year_over_year']);
        $this->assertCount(12, $summary['trend']);
        $this->assertSame('2031-03', $summary['trend'][11]['period']);
        $this->assertSame(80.0, $summary['trend'][11]['amount']);
        $this->assertSame($customer, $summary['top_customers'][0]['id']);
        $this->assertSame(80.0, $summary['top_customers'][0]['amount']);
    }

    public function test_year_over_year_is_null_when_previous_period_has_no_sales()
    {
        $summary = app(SalesAnalysisService::class)->dashboardSalesSummary(
            Carbon::create(2045, 2, 10, 12, 0, 0, 'Asia/Taipei')
        );

        $this->assertNull($summary['year_over_year']);
        $this->assertSame(0.0, $summary['current_month']);
        $this->assertSame(0.0, $summary['previous_year_month']);
    }

    public function test_receivables_overdue_threshold_and_material_stock_rules()
    {
        config(['shangda.dashboard.overdue_days' => 30]);
        $now = Carbon::create(2037, 6, 30, 12, 0, 0, 'Asia/Taipei');
        $service = app(DashboardService::class);
        $baseline = $service->data($now);

        $partial = $this->createConsumer('部分付款');
        $exact = $this->createConsumer('剛好三十天');
        $overdue = $this->createConsumer('逾期三十一天');
        $noDueDate = $this->createConsumer('未填付款期限');

        $this->createReceivable($partial, 50, '2037-07-10 08:00:00', '2037-06-01 08:00:00');
        $this->createReceivable($exact, 30, '2037-05-31 08:00:00');
        $this->createReceivable($overdue, 75, '2037-05-30 08:00:00');
        $this->createReceivable($noDueDate, 25, null);
        $this->createReceivable($this->createConsumer('未核准'), 500, '2037-01-01 08:00:00', null, 0, 1);
        $this->createReceivable($this->createConsumer('退貨'), 500, '2037-01-01 08:00:00', null, 1, 2);
        $this->createReceivable($this->createConsumer('零餘額'), 0, '2037-01-01 08:00:00');

        $lowId = DB::table('materials')->insertGetId([
            'name' => 'Dashboard Low Material', 'unit' => 1, 'stock' => 2, 'safeQuantity' => 10,
            'created_at' => now(), 'updated_at' => now(),
        ]);
        $equalId = DB::table('materials')->insertGetId([
            'name' => 'Dashboard Equal Material', 'unit' => 1, 'stock' => 10, 'safeQuantity' => 10,
            'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('materials')->insert([
            'name' => 'Dashboard Unset Material', 'unit' => 1, 'stock' => 0, 'safeQuantity' => 0,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        $data = $service->data($now);

        $this->assertSame($baseline['receivables']['balance'] + 180.0, $data['receivables']['balance']);
        $this->assertSame($baseline['receivables']['customer_count'] + 4, $data['receivables']['customer_count']);
        $this->assertSame($baseline['overdue']['balance'] + 75.0, $data['overdue']['balance']);
        $this->assertSame($baseline['overdue']['customer_count'] + 1, $data['overdue']['customer_count']);
        $this->assertSame($baseline['materials']['low_stock_count'] + 1, $data['materials']['low_stock_count']);

        $levels = collect($data['materials']['levels'])->keyBy('id');
        $this->assertTrue($levels->has($lowId));
        $this->assertTrue($levels->has($equalId));
        $this->assertTrue($levels[$lowId]['is_low']);
        $this->assertFalse($levels[$equalId]['is_low']);
    }

    private function createConsumer($name)
    {
        $token = uniqid('consumer_', true);

        return DB::table('consumers')->insertGetId([
            'account' => substr(str_replace('.', '', $token), 0, 30),
            'password' => bcrypt('password'),
            'name' => $name,
            'email' => $token . '@example.test',
            'user_id' => $this->userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function createOrder($consumerId, $transactionAt, $status, $confirmStatus, $amount)
    {
        $orderId = $this->insertOrder($consumerId, [
            'transaction_at' => $transactionAt,
            'status' => $status,
            'confirmStatus' => $confirmStatus,
            'totalPrice' => $amount,
            'totalTaxPrice' => $amount,
            'unpaidAmount' => $status === 1 ? $amount : 0,
        ]);

        DB::table('sales_order_details')->insert([
            'sales_order_id' => $orderId,
            'product_id' => $this->productId,
            'count' => 1,
            'price' => $amount,
            'quantity' => 1,
            'discount' => 1,
            'subTotal' => $amount,
        ]);

        return $orderId;
    }

    private function createReceivable($consumerId, $unpaidAmount, $expectPayAt, $paidAt = null, $confirmStatus = 1, $status = 1)
    {
        return $this->insertOrder($consumerId, [
            'transaction_at' => '2037-06-01 08:00:00',
            'expectPay_at' => $expectPayAt,
            'paid_at' => $paidAt,
            'status' => $status,
            'confirmStatus' => $confirmStatus,
            'totalPrice' => $unpaidAmount,
            'totalTaxPrice' => $unpaidAmount,
            'unpaidAmount' => $unpaidAmount,
        ]);
    }

    private function insertOrder($consumerId, array $overrides)
    {
        $this->sequence++;
        $now = now();
        $defaults = [
            'consumer_id' => $consumerId,
            'user_id' => $this->userId,
            'last_user_id' => $this->userId,
            'shown_id' => 'DASH' . strtoupper(substr(md5(uniqid('', true)), 0, 16)) . $this->sequence,
            'status' => 1,
            'confirmStatus' => 1,
            'totalPrice' => 0,
            'taxPrice' => 0,
            'totalTaxPrice' => 0,
            'paidAmount' => 0,
            'unpaidAmount' => 0,
            'overpaidAmount' => 0,
            'taxType' => 2,
            'invoiceType' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        return DB::table('sales_orders')->insertGetId(array_merge($defaults, $overrides));
    }
}
