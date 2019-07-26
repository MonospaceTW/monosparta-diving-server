<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\spot;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(spot::class, function (Faker $faker) {
    // $faker = Faker\Factory::create('zh_TW');
    return [
        //
        'level' => str_random(6),
        'location' => str_random(5),
        'name' => str_random(10),
        'description' => $faker->text(100),
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'img1' => $faker->imageUrl(),
        'img2' => $faker->imageUrl(),
        'img3' => $faker->imageUrl(),
        'img4' => $faker->imageUrl(),
        'img5' => $faker->imageUrl(),
    ];
});
