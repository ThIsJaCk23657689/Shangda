<?php

use App\Category;
use Illuminate\Database\Seeder;
use App\Category as CategoryEloquent;

class CatedoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory(CategoryEloquent::class, 50)->create();
    }
}
