<?php

use Illuminate\Database\Seeder;
use App\Information as InformationEloquent;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InformationEloquent::create([
            'cover_image' => 'images/background/welcome.jpg'
        ]);
    }
}
