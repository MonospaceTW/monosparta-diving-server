<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\comments;
use Faker\Generator as Faker;

$factory->define(comments::class, function (Faker $faker) {
    $spots = App\spots::pluck('id')->toArray();
    return [
        //
        'comment' => $faker->text(100),
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'spot_id' => $faker->randomElement($spots),
    ];
});
