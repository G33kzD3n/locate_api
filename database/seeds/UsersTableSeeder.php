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
        $this->createStudents(12, 8840, ['8', '1', '3', '4', '2', '4', '4', '8', '1', '8', '8', '1', '3', '8', '16', '6', '8', '7']);
        $this->createStudents(12, 8839, ['18', '11', '13', '14', '12', '14', '14', '18', '19', '14', '12', '11', '10', '19', '13', '16', '17']);
        $this->createStudents(12, 8801, ['28', '21', '23', '24', '22', '24', '24', '28', '20', '28', '27', '30', '31', '32', '34', '23', '20', '22']);
        $this->createCordinators(3);
        $this->createDrivers(3);
    }

    public function createStudents($no, $bus_no, array $stops)
    {
        $faker = Faker::create();
        foreach (range(1, $no) as $index) {
            User::Create([
                'username'              => $faker->unique()->numberBetween($min = 15045112000, $max = 15045115098),
                'password'              => bcrypt('1990-01-01'), //d.o.b as year-month-date
                'api_token'             => str_random(60),
                'level'                 => '0',
                'name'                  => $faker->name,
                'bus_no'                => $bus_no,
                'dept_id'               => $faker->randomElement(['PGDCS', 'DCSE', 'PGDENG', 'DMS']),
                'course_id'             => $faker->randomElement(['MCA', 'BTECHCSE', 'MA', 'IMBA']),
                'semester'              => $faker->randomElement(['4', '2', '3', '1']),
                'avatar'                => "path_to_image",
                'registered_on'         => $faker->randomElement(['2015-07-10', '2016-01-01', '2017-01-22', '2018-02-02', '2015-06-20']),
                'phone_no'              => $faker->unique()->numberBetween($min = 9018556691, $max = 9108666691),
                 'stop_id'              => $faker->randomElement($stops),
            ]);
        }
    }

    public function createCordinators($no)
    {
        $faker = Faker::create();
        $buses = [8840, 8801, 8839];
        foreach (range(1, $no) as $index) {
            User::Create([
             'username'          => $faker->unique()->numberBetween($min = 99999992001, $max = 99999992004),
             'password'          => bcrypt('1990-01-01'), //d.o.b as year-month-date
             'api_token'         => str_random(60),
             'level'             => '2',
             'name'              => $faker->name,
             'bus_no'            => $buses[$index - 1],
             'dept_id'           => $faker->randomElement(['PGDCS', 'DCSE', 'PGDENG', 'DMS']),
             'phone_no'          => $faker->unique()->numberBetween($min = 9797556691, $max = 9797666691),
             'avatar'            => "path_to_image",
             'registered_on'     => $faker->randomElement(['2001-01-12', '2006-11-21', '2005-11-21', '2016-12-02', '2005-06-20']),
             'stop_id'           => $faker->randomElement([1, 12, 13, 14, 15, 6, 7, 9, 2, 20, 10])
            ]);
        }
    }

    public function createDrivers($no)
    {
        $faker  = Faker::create();
        $buses  = [8840, 8801, 8839];
        foreach (range(1, $no) as $index) {
            User::Create([
             'username'           => $faker->unique()->numberBetween($min = 55555552001, $max = 55555552004),
             'password'           => bcrypt('1990-01-01'), //d.o.b as year-month-date
             'api_token'          => str_random(60),
             'level'              => '1',
             'name'               => $faker->name,
             'bus_no'             => $buses[$index - 1],
             'dept_id'            => 'TD',
             'phone_no'           => $faker->unique()->numberBetween($min = 9419556691, $max = 9419666691),
             'avatar'             => "path_to_image",
             'registered_on'      => $faker->randomElement(['2010-01-12', '1999-11-21', '2015-11-21', '2015-12-02', '2005-06-20'])
            ]);
        }
    }
}
