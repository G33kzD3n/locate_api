<?php

use App\Bus;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buses     = [1 => 8840, 2 => 8801, 3 => 8839];
        $faker     = Faker::create();
        foreach (range(1, 3) as $index) {
            Bus::create([
                'bus_no'        => $buses[$index],
                'gps_device_id' => $faker->Uuid()
            ]);
        }
    }
}
