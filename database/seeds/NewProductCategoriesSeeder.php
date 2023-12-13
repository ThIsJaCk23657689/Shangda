<?php

use Illuminate\Database\Seeder;
use App\Category as CategoryEloquent;

class NewProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryEloquent::create([
            'name' => 'LD透明袋（清袋）',
            'intro' => '',
        ]);
        CategoryEloquent::create([
            'name' => '條袋',
            'intro' => '',
        ]);
        CategoryEloquent::create([
            'name' => '單色袋',
            'intro' => '',
        ]);
        CategoryEloquent::create([
            'name' => '垃圾袋',
            'intro' => '',
        ]);
    }
}
