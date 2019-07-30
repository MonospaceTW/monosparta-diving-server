<?php

/** @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $commentable = [
        App\Spot::class,
        App\Shop::class,
    ];
    return [
        'comment' => $faker->text(100),
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'commentable_type' => $faker->randomElement($commentable),
        'commentable_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,10)
    ];
});
