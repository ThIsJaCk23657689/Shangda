<?php

use Illuminate\Database\Seeder;
use App\Material as MaterialEloquent;

class MaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = factory(MaterialEloquent::class, 10)->create();
    }
}
