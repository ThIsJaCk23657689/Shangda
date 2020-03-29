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
            'intro' => '',
        ]);
        CategoryEloquent::create([
            'name' => '雜項',
            'intro' => '',
        ]);
        CategoryEloquent::create([
            'name' => '耐熱袋',
            'intro' => '',
        ]);
        CategoryEloquent::create([
            'name' => '提袋',
            'intro' => '',
        ]);
        CategoryEloquent::create([
            'name' => '杯袋',
            'intro' => '',
        ]);
        CategoryEloquent::create([
            'name' => '碗袋',
            'intro' => '',
        ]);
        CategoryEloquent::create([
            'name' => '湯袋',
            'intro' => '',
        ]);
        // CategoryEloquent::create([
        //     'name' => '客製化塑膠袋',
        //     'intro' => '',
        // ]);
        // $categories = factory(CategoryEloquent::class, 10)->create();
    }
}
