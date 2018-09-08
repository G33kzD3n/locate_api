<?php

use App\Fee;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker     = Faker::create();
        $usernames = DB::table('users')->where('level', '0')->orWhere('level', '2')->pluck('username');
        foreach (range(1, 9) as $index) {
            foreach ($usernames as $username) {
                if ($username === 15045112010 || $username === 15045112037) {
                    Fee::Create([
                          'username'  => $username,
                          'fee'       => (int)2000,
                          'due_date'  => '2018-0'.$index.'-01',
                          'paid'      => 0
                    ]);
                } else {
                    Fee::Create([
                          'username'  => $username,
                          'fee'       => (int)2000,
                          'due_date'  => '2018-0'.$index.'-01',
                          'paid'      => $faker->randomElement([1, 0])
                ]);
                }
            }
        }
    }
}
