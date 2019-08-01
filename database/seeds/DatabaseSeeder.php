<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create();

        factory(App\Spot::class, 10)->create();

        factory(App\Shop::class, 10)->create();

        factory(App\Comment::class, 100)->create();

        factory(App\Article::class, 25)->create();

    }
}
