<?php

use Illuminate\Database\Seeder;
use App\JobTitle as JobTitleEloquent;

class JobTitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // JobTitleEloquent::create([
        //     'name' => '廠務'
        // ]);

        // JobTitleEloquent::create([
        //     'name' => '業務'
        // ]);

        // JobTitleEloquent::create([
        //     'name' => '管理者'
        // ]);

        // JobTitleEloquent::create([
        //     'name' => '最高管理者'
        // ]);

        JobTitleEloquent::create([
            'name' => '操作員'
        ]);

    }
}
