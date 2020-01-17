<?php

use App\Category;
use Illuminate\Database\Seeder;
use App\Category as CategoryEloquent;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryEloquent::create([
            'name' => '未分類商品',
            'intro' => '尚未分類的商品，孤單寂寞覺得冷。',
        ]);
        $categories = factory(CategoryEloquent::class, 10)->create();
    }
}
