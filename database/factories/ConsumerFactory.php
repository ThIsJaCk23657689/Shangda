<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Consumer;
use Faker\Generator as Faker;

$factory->define(Consumer::class, function (Faker $faker) {
    
    $consumer_data = [];
    $account_type = $faker->numberBetween($min = 0, $max = 1);

    if($account_type == 0){
        // 創建個人帳號
        $consumer_data = [
            'shortName' => $faker->userName,
            'monthlyCheckDate' => $faker->numberBetween($min = 0, $max = 31), 
            'uncheckedAmount' => 0,
            'totalConsumption' => 0,
            'comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
            'account_type' => $account_type,
            'who_created' => $faker->numberBetween($min = 0, $max = 1),

            'account' => $faker->unique()->userName, 
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'name' => $faker->name,
            'gender' => $faker->numberBetween($min = 0, $max = 2),
            // 'idNumber' => $faker->unique()->bothify('?#########'),
            'birthday' => $faker->numberBetween($min = 1930, $max = 2002) . '-' . $faker->numberBetween($min = 1, $max = 12) . '-' . $faker->numberBetween($min = 1, $max = 28),
            
            'phone' => $faker->bothify('09########'),
            'email' => $faker->unique()->safeEmail,
            'lineID' => $faker->userName,
            'address_zipcode' => '404', 
            'address_county' => '台中市', 
            'address_district' => '北區', 
            'address_others' => '太平路62號5樓之10',
             
            'policy_agreement' => 1, 
        ];
    }else{
        // 創建公司帳號
        $consumer_data = [
            'shortName' => $faker->userName,
            'monthlyCheckDate' => $faker->numberBetween($min = 0, $max = 31), 
            'uncheckedAmount' => 0,
            'totalConsumption' => 0,
            'comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
            'account_type' => $account_type,
            'who_created' => $faker->numberBetween($min = 0, $max = 1),

            'account' => $faker->unique()->userName, 
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'name' => $faker->name,
            'taxID' => $faker->unique()->bothify('########'),
            'principal' => $faker->name,
            'gender' => $faker->numberBetween($min = 0, $max = 2),
            // 'idNumber' => $faker->unique()->bothify('?#########'),

            'tel' => $faker->randomElement(['02', '03', '04', '05', '06']) . str_pad($faker->numberBetween(100000, 999999), 6, '0', STR_PAD_LEFT), 
            'tax' => $faker->randomElement(['02', '03', '04', '05', '06']) . str_pad($faker->numberBetween(100000, 999999), 6, '0', STR_PAD_LEFT), 
            'email' => $faker->unique()->safeEmail,
            'lineID' => $faker->userName,

            'operator_name_1' => $faker->name,
            'operator_tel_1' => $faker->randomElement(['02', '03', '04', '05', '06']) . str_pad($faker->numberBetween(100000, 999999), 6, '0', STR_PAD_LEFT),
            'operator_phone_1' => $faker->bothify('09########'),
            'operator_email_1' => $faker->unique()->safeEmail,

            'address_zipcode' => '404', 
            'address_county' => '台中市', 
            'address_district' => '北區', 
            'address_others' => '太平路62號5樓之10',

            'deliveryAddress_zipcode' => '404', 
            'deliveryAddress_county' => '台中市', 
            'deliveryAddress_district' => '北區', 
            'deliveryAddress_others' => '太平路62號5樓之10',
             
            'policy_agreement' => 1, 
        ];
    }
    
    return $consumer_data;
});
