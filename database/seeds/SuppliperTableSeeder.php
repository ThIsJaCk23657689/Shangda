<?php

use Illuminate\Database\Seeder;
use App\Supplier as SupplierEloquent;

class SuppliperTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = factory(SupplierEloquent::class, 10)->create();
        SupplierEloquent::create([
            'name' => '哈哈',
            'shortName' => '哈哈',
            'taxId' => '12345678',
            'tel' => '0912345678',
            'tax' => '0912345678',
            'inCharge1' => '哈哈',
            'tel1' => '0912345678',
            'email1' => 'feeefe@gmail.com',
            'companyAddress' => '哈哈',
            'deliveryAddress' => '哈哈',
            'invoiceAddress' => '哈哈',
            'comment' => null,
        ]);
    }
}
