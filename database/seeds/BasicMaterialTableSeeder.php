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
        BasicMaterialEloquent::create([
            'name' => '高密度聚乙烯（HDPE）',
            'price' => '50',
        ]);

        BasicMaterialEloquent::create([
            'name' => '低密度聚乙烯（LDPE）',
            'price' => '50',
        ]);

        BasicMaterialEloquent::create([
            'name' => '聚丙烯（PP）',
            'price' => '50',
        ]);

        BasicMaterialEloquent::create([
            'name' => '聚氯乙烯（PVC）',
            'price' => '50',
        ]);

        BasicMaterialEloquent::create([
            'name' => '醋酸乙烯（EVA）',
            'price' => '50',
        ]);
    }
}
