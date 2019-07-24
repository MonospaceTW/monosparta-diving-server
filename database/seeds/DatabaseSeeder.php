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
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 10)->create();

        factory(App\spots::class, 10)->create();

        factory(App\shops::class, 10)->create();

        factory(App\comments::class, 20)->create();

    }
}
