<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'category' => $faker->randomElement(["knowledge", "travel", "license"]),
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'date' => $faker->date($format = 'Y/m/d', $max = 'now'),
        'author' => $faker->name,
        'img' => $faker->imageUrl,
        'url' => $faker->url,
        'content' => $faker->text(100),
    ];
});
