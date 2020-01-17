<?php

use Illuminate\Database\Seeder;
use App\Consumer as ConsumerEloquent;

class ConsumerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consumer = factory(ConsumerEloquent::class, 50)->create();
    }
}
