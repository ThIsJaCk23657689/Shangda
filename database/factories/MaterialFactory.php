<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Material;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'shortName' => $faker->userName,
        'internationalNum' => $faker->numberBetween($min = 10000000, $max = 99999999),
        'unit' => $faker->numberBetween($min = 1, $max = 2),
        'unitPrice' => $faker->numberBetween($min = 1, $max = 99),
        'stock' => $faker->numberBetween($min = 1, $max = 9999),
        'comment' => null,
    ];
});
