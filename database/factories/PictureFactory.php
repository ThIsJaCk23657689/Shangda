<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Picture;
use Faker\Generator as Faker;

$factory->define(Picture::class, function (Faker $faker) {
    return [
        'url' => 'https://fakeimg.pl/250x250/' . substr($faker->hexcolor, 1) . '/' . substr($faker->hexcolor, 1) . '/',
        'index' => 0
    ];
});
