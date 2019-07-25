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

        factory(App\spot::class, 10)->create();

        factory(App\shop::class, 10)->create();

        factory(App\comment::class, 100)->create();

    }
}
