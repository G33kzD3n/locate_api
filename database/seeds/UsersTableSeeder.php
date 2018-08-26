<?php

use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            User::Create(
                [
                'username' => $faker->unique()->numberBetween($min = 15045112000, $max = 15045112038),
                'password' => bcrypt('1990-01-01'),
                'token'    => str_random(60),
                'level'    => $faker->randomElement(['0', '1', '2'])
                ]
            );
        }
    }
}
