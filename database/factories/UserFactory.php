<?php

use Faker\Generator as Faker;

$factory->define(
    App\User::class,
    function (Faker $faker) {
        return [
               'course_id' => 'undefined',
               'semester'  => null,
               'stop_id'   => null
        ];
    }
);
