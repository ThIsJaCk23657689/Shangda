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
        
        'inCharge1' => $faker->name,
        'tel1' => '09' . $faker->numberBetween($min = 10000000, $max = 99999999),
        'email1' => $faker->safeEmail,

        'CompanyAddress_zipcode' => '404',
        'CompanyAddress_county' => '臺中市',
        'CompanyAddress_district' => '北區',
        'CompanyAddress_others' => '太平路62號5樓之10',
        
        'comment' => null,
    ];
});
