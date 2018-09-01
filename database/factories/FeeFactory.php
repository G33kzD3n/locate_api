<?php

use App\Fee;
use Faker\Generator as Faker;

$factory->define(App\Fee::class, function (Faker $faker) {
    return [
        'username'  => factory(App\User::class)->create()->username,
        'fee'       => (int)2000,
        'due_date'  => date('Y-m-d'),
        'paid'      => (int)0
    ];
});
