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
    }
}
