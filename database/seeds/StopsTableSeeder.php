<?php

use App\Stop;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class StopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker      = Faker::create();
        $stop_names = [
         1  => [ 'Kashmir University,Main Campus', '34.129881', '74.836936'],
         2  => ['Kanitar', '34.135726', '74.828302'],
         3  => ['Omar Colony', '34.133820', '74.824463'],
         4  => ['Salfia', '34.13890', '74.821693'],
         5  => ['Lal Bazar', '34.127520', '34.812982'],
         6  => ['Molvi Stop', '34.123011', '74.816494'],
         7  => ['Bota Kadal', '34.120178', '74.813594'],
         8  => ['Mill Stop', '34.120390', '74.806293'],
         9  => ['Alamgari Bazar', '34.119586', '74.80666'],
         10 => ['Hawal', '34.111408', '74.809138'],
         11 => ['Islamia College', '34.104483', '74.808966'],
         12 => ['Gojwara', '34.101022', '74.809374'],
         13 => ['Rajori kadal', '34.099410', '74.205449'],
         14 => ['Kawdara', '34.098961', '74.802270'],
         15 => ['Nawa kadal', '34.095895', '74.798385']
        ];

        // $bus_nos = DB::table('buses')->pluck('bus_no');
        foreach (range(1, 15) as $index) {
            Stop::create([
               'lat'         => (string)$stop_names[$index][1],
               'long'        => (string)$stop_names[$index][2],
               'bus_no'      => 8840,
               'name'        => (string)$stop_names[$index][0],
               'stops_order' => (int)$index
            ]);
        }
    }
}
