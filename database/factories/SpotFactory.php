<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Spot;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Spot::class, function (Faker $faker) {
    return [
        'level' => $faker->randomElement(["easy", "medium", "hard"]),
        'location' => $faker->randomElement(["north", "east", "south", "mid", "outer"]),
        'name' => $faker->state(),
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
