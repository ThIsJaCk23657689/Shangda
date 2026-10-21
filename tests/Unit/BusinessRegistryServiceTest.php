<?php

namespace Tests\Unit;

use App\Services\BusinessRegistryService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BusinessRegistryServiceTest extends TestCase
{
    public function test_it_rejects_a_malformed_tax_id_without_an_http_request(): void
    {
        Http::fake();

        $result = app(BusinessRegistryService::class)->lookup('123');

        $this->assertSame('0', $result['status']);
        Http::assertNothingSent();
    }

    public function test_it_returns_company_registry_data(): void
    {
        Http::fakeSequence()
            ->push([['exist' => 'Y'], ['exist' => 'N'], ['exist' => 'N']])
            ->push([['Business_Accounting_NO' => '12345678', 'Company_Name' => '測試公司']]);

        $result = app(BusinessRegistryService::class)->lookup('12345678');

        $this->assertSame('3', $result['status']);
        $this->assertSame('公司', $result['type']);
        $this->assertSame('12345678', $result['result'][0]['Business_Accounting_NO']);
    }
}
