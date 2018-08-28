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
                    'username'      => $faker->unique()
                        ->numberBetween(
                            $min = 15045112000,
                            $max = 15045112038
                        ),
                    'password'          => bcrypt('1990-01-01'), //d.o.b as year-month-date
                    'api_token'         => str_random(60),
                    'level'             => $faker->randomElement(['0', '1', '2']),
                    'name'              => $faker->name,
                    'bus_no'            => $faker->randomElement([8840, 8801, 8839]),
                    'dept_id'           => $faker->randomElement(
                        ['PGDCS', 'DCSE', 'PGDENG', 'DMS', 'TD']
                    ),
                    'course_id'     => $faker->randomElement(
                        ['MCA', 'BTECHCSE', 'MA', 'IMBA']
                    ),
                    'semester'      => $faker->randomElement([1, 2, 3, 4]),
                    'avatar'        => "path_to_image",
                    'registered_on' => $faker->randomElement(
                        [
                        '2015-07-10', '2016-01-01', '2017-01-22',
                             '2018-02-02', '2015-06-20']
                    ),
                    'phone_no'      => $faker->unique()
                        ->numberBetween(
                            $min = 9018556691,
                            $max = 9108666691
                        ),
                ]
            );
        }
    }
}
