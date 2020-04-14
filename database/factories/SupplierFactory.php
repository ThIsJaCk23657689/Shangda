<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'shortName' => $faker->userName,
        'taxId' => $faker->numberBetween($min = 10000000, $max = 99999999),

        'tel' => '09' . $faker->numberBetween($min = 10000000, $max = 99999999),
        'tax' => '0' . $faker->numberBetween($min = 1, $max = 9) . $faker->numberBetween($min = 10000000, $max = 99999999),
        
        'operator_name_1' => $faker->name,
        'operator_tel_1' => '09' . $faker->numberBetween($min = 10000000, $max = 99999999),
        'operator_email_1' => $faker->safeEmail,

        'companyAddress_zipcode' => '404',
        'companyAddress_county' => '臺中市',
        'companyAddress_district' => '北區',
        'companyAddress_others' => '太平路62號5樓之10',

        'bank_name' => $faker->randomElement(['中國信託', '玉山銀行', '渣打銀行', '台灣銀行', '花旗銀行', '星展銀行']),
        
        'comment' => null,
    ];
});
