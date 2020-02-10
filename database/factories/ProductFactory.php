<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\BasicMaterial as BasicMaterialEloquent;
use Faker\Generator as Faker;



$factory->define(Product::class, function (Faker $faker) {
    $x1 = BasicMaterialEloquent::find(1)->price;
    $x2 = BasicMaterialEloquent::find(2)->price;
    $x3 = BasicMaterialEloquent::find(3)->price;
    $x4 = BasicMaterialEloquent::find(4)->price;
    $x5 = BasicMaterialEloquent::find(5)->price;

    $fund_price = $faker->randomFloat(2, 0, 1000);
    $c1 = $faker->randomFloat(2, 0, 1);
    $c2 = $faker->randomFloat(2, 0, 1);
    $c3 = $faker->randomFloat(2, 0, 1);
    $c4 = $faker->randomFloat(2, 0, 1);
    $c5 = $faker->randomFloat(2, 0, 1);
    $retail_price = $x1 * $c1 + $x2 * $c2 + $x3 * $c3 + $x4 * $c4 + $x5 * $c5 + $fund_price;
    return [
        'category_id' => $faker->numberBetween($min = 3, $max = 8),
        'name' => $faker->name,
        'shortName' => $faker->userName,
        'internationalNum' => $faker->numberBetween($min = 10000000, $max = 99999999),

        'fundamentalPrice' => $fund_price,
        'retailPrice' => $retail_price,
        'materialCoefficient1' => $c1,
        'materialCoefficient2' => $c2,
        'materialCoefficient3' => $c3,
        'materialCoefficient4' => $c4,
        'materialCoefficient5' => $c5,

        'picture' => 'https://fakeimg.pl/250x250/' . substr($faker->hexcolor, 1) . '/' . substr($faker->hexcolor, 1) . '/',
        'intro' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'specification' => $faker->word,
        'unit' => $faker->randomElement($array = array ('g','kg','mt')),
        'quantity' => $faker->numberBetween($min = 0, $max = 9000),
        'safeQuantity' => $faker->numberBetween($min = 10, $max = 9000),
        'comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
    ];
});
