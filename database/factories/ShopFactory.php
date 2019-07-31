<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory*/

use App\Shop;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'service' => $faker->randomElement(["ExploreDiving", "LicenseCourse", "Food", "Accommodation", "EquipmentSale"], $count = 3),
        'location' => $faker->randomElement(["north", "east", "south", "mid", "outer"]),
        'name' => $faker->state(),
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
