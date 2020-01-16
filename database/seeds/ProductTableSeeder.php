<?php

use Illuminate\Database\Seeder;
use App\Product as ProductEloquent;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = factory(ProductEloquent::class, 10)->create();
    }
}
