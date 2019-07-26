<?php

/** @var $factory \Illuminate\Database\Eloquent\Factory */

use App\comment;
use Faker\Generator as Faker;

$factory->define(comment::class, function (Faker $faker) {
    $spot = App\spot::pluck('id')->toArray();
    $user = App\User::pluck('id')->toArray();
    return [
        //
        'comment' => $faker->text(100),
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'user_id' => $faker->randomElement($user),
        'spot_id' => $faker->randomElement($spot),
    ];
});
