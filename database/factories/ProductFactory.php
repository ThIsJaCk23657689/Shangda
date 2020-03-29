<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Category as CategoryEloquent;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $specification = $faker->randomElement(['四兩', '六兩', '大六兩', '半斤', '一斤', '兩斤', '三斤', '五斤', '七斤', '十斤', '十五斤', '二十斤']);
    $color = $faker->randomElement(['紅', '橙', '黃', '綠', '藍', '紫', '黑', '白', null]);
    $weight = $faker->randomElement(['5', '6', '7', '8', '10', '10.5', '11', '12', '0']);
    if($weight != '0'){
        $weight_text = " ($weight) ";
    }else{
        $weight_text = "";
    }

    $unit = $faker->randomElement(['package', 'kg', 'roll']);
    $qty_per_pack = $faker->randomElement(['12', '60', '100', '50', '25', '80']);
    if($unit == 'kg'){
        $qty_per_pack_text = $qty_per_pack . 'KG';
    }else{
        $qty_per_pack_text = $qty_per_pack;
    }

    $category_id = $faker->numberBetween($min = 3, $max = 7);
    $category_name = CategoryEloquent::find($category_id)->name;

    $pack_unit = '1 * ';
    if($category_name == '耐熱袋' && $unit == 'package'){
        $pack_unit = '1P * ';
    }else if($unit == 'roll'){
        $pack_unit = '5P * ';
    }
    $name = $color . $category_name . $specification . ' ' . $pack_unit . $qty_per_pack_text . $weight_text;
    
    return [
        'category_id' => $category_id,
        
        'shownID' => $faker->numberBetween($min = 1, $max = 99) . '-' . str_pad($faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
        'name' => $name,
        'internationalNum' => $faker->numberBetween($min = 471920000000, $max = 471929999999),
        // 'picture' => 'https://fakeimg.pl/250x250/' . substr($faker->hexcolor, 1) . '/' . substr($faker->hexcolor, 1) . '/',
        'specification' => $specification,
        'color' => $color,

        'length' => $faker->numberBetween($min = 10, $max = 99),
        'width' => $faker->numberBetween($min = 10, $max = 99),
        'chamfer' => $faker->numberBetween($min = 0, $max = 99),

        'weight' => $weight,
        'qty_per_pack' => $qty_per_pack,
        'unit' => $unit,
        'intro' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'quantity' => $faker->numberBetween($min = 0, $max = 9999),
        'safeQuantity' => $faker->numberBetween($min = 10, $max = 3333),
        'comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),

        'costprice' => 0,
        'profit' => 0,
        'retailPrice' => 0,
    ];
});
