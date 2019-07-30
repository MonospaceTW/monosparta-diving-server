<?php

/** @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        //
        'comment' => $faker->text(100),
        'rating' => $faker->numberBetween($min = 1, $max = 5)
    ];
});
