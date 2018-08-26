<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(
    App\User::class,
    function (Faker $faker) {
        return [
            'username' => $faker->unique()->numberBetween($min = 15045112000, $max = 15045112038),
            'password' => bcrypt('1990-01-01'), //d.o.b as year-month-date
            'token'    => str_random(10),
            'level'    => $faker->randomElement(['0', '1', '2']),
        ];
    }
);
