<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Consumer;
use Faker\Generator as Faker;

$factory->define(Consumer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'shownID' => 'sd' . str_pad($faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
        'act' => $faker->unique()->bothify('?????###'),
        'pwd' => $faker->unique()->bothify('?????###'),
        'taxID' => $faker->unique()->bothify('########'),
        'idNumber' => $faker->unique()->bothify('?#########'),
        'inCharge1' => $faker->name,
        'tel1' => $faker->e164PhoneNumber(),
        'email1' => $faker->email(),
        'inCharge2' => $faker->name,
        'tel2' => $faker->e164PhoneNumber(),
        'tax' => $faker->e164PhoneNumber(),
        'email2' => $faker->email(),
        'monthlyCheckDate'=>'5',
        'uncheckedAmount'=>0,
        'totalConsumption'=>0,
        'companyAddress'=>$faker->address(),
        'deliveryAddress'=>$faker->address(),
        'invoiceAddress'=>$faker->address(),
        'comment'=>$faker->realText($maxNbChars = 200, $indexSize = 2),
    ];
});
