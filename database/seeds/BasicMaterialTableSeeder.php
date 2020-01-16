<?php

use Illuminate\Database\Seeder;
use App\BasicMaterial as BasicMaterialEloquent;

class BasicMaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $basic_material_1 = BasicMaterialEloquent::create([
            'name' => 'material_1',
            'price' => '80',
        ]);

        $basic_material_2 = BasicMaterialEloquent::create([
            'name' => 'material_2',
            'price' => '90',
        ]);

        $basic_material_3 = BasicMaterialEloquent::create([
            'name' => 'material_3',
            'price' => '100',
        ]);

        $basic_material_4 = BasicMaterialEloquent::create([
            'name' => 'material_4',
            'price' => '110',
        ]);

        $basic_material_5 = BasicMaterialEloquent::create([
            'name' => 'material_5',
            'price' => '120',
        ]);
    }
}
