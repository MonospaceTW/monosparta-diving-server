<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory*/

use App\shop;
use Faker\Generator as Faker;

$factory->define(shop::class, function (Faker $faker) {
    return [
        //
        'service' => str_random(10),
        'location' => str_random(5),
        'name' => str_random(10),
        'description' => $faker->text(100),
        'longitude' => $faker->longitude(),
        'latitude' => $faker->latitude(),
        'img1' => $faker->imageUrl(),
        'img2' => $faker->imageUrl(),
        'img3' => $faker->imageUrl(),
        'img4' => $faker->imageUrl(),
        'img5' => $faker->imageUrl(),
    ];
});
