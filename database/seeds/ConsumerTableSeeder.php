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
        ConsumerEloquent::create([
            'account' => '23657689',
            'password' => bcrypt('jack0619'),
            'idNumber' => 'O100510818',
            'name' => '張竣傑',
            'gender' => 1,
            'monthlyCheckDate' => 25,
            'phone' => '0986911588',
            'email' => 'y23657689@gmail.com',
            'address_zipcode' => '404', 
            'address_county' => '台中市', 
            'address_district' => '北區', 
            'address_others' => '太平路62號5樓之10',
        ]);
        $consumer = factory(ConsumerEloquent::class, 20)->create();
    }
}
