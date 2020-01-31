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
        JobTitleEloquent::create([
            'name' => '廠長'
        ]);

        JobTitleEloquent::create([
            'name' => '基層員工'
        ]);

        JobTitleEloquent::create([
            'name' => '經理'
        ]);

        JobTitleEloquent::create([
            'name' => '主管'
        ]);
    }
}
