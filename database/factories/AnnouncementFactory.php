<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Announcement;
use Faker\Generator as Faker;

$factory->define(Announcement::class, function (Faker $faker) {
    return [
        'last_update_user_id' => 1,
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'content' => $faker->paragraph,
        'cover_image' => 'https://fakeimg.pl/500x500/' . substr($faker->hexcolor, 1) . '/' . substr($faker->hexcolor, 1) . '/',
    ];
});
