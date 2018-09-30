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
         4  => ['Salfia', '34.132084', '74.821662'],
         5  => ['Lal Bazar', '34.127520', '74.815982'],
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
        $stop_names2 = [
         1  => [ 'Kashmir University,Main Campus', '34.129881', '74.836936'],
         2  => ['Hazrat Bal', '34.12784', '74.838909'],
         3  => ['Saida Kadal', '34.10449', '74.827405'],
         4  => ['Kathi Darwaza', '34.102423', '74.822239'],
         5  => ['Rainawari', '34.097554', '74.823063'],
         6  => ['Khaniyar Bus Stop', '34.091811', '74.8191957'],
         7  => ['Dalgate', '34.080082', '74.829237'],
         8  => ['Lal Chowk', '34.071726', '74.809050'],
         9  => ['Batmaloo', '34.074565', '74.796936'],
         10 => ['Bemina', '34.081463', '74.784241'],
         11 => ['Bemina ByePass Chowk', '34.072393', '74.768474'],
         12 => ['Parimpora', '34.106171', '74.754659'],
         13 => ['Shalteng', '34..109046', '74.745431'],
         14 => ['Narbal Petrol Pump', '34.120777', '74.683791'],
         15 => ['Khanepeth', '34.134897', '74.666470']
        ];
        $stop_names3 = [
        1  => ['main campus', '34.129317', '74.836469'],
        2  => ['Habak', '34.140780', '74.838467'],
        3  => ['Illahibag', '34.152118', '74.808407'],
        4  => ['Buchpora', '34.152669', '74.802378'],
        5  => ['Soura, HDFC Bank', '34.144140', '74.801936'],
        6  => ['Soura Skims', '34.135864', '74.803159'],
        7  => ['Ali Jan Road', '34.123066', '74.794547'],
        8  => ['Eidgah', '34.104764', '74.794839'],
        9  => ['Sekidafar', '34.095523', '74.791363'],
        10 => ['Qamarwari', '34.091182', '74.777437'],
        11 => ['Parimpora', '34.106168', '74.755028'],
        12 => ['Narbal', '34.121324', '74.678477'],
        13 => ['Pattan', '34.161569', '74.554235'],
        14 => ['Sangrama', '34.243401', '74.448253'],
        15 => ['North Campus', '34.232381', '74.416266']
        ];
        $this->allotStopsToBus($stop_names, 8840);
        $this->allotStopsToBus($stop_names2, 8839);
        $this->allotStopsToBus($stop_names3, 8801);
    }

    public function allotStopsToBus($stop_names, $bus_no)
    {
        foreach (range(1, 15) as $index) {
            Stop::create([
               'lat'         => (string)$stop_names[$index][1],
               'long'        => (string)$stop_names[$index][2],
               'bus_no'      => $bus_no,
               'name'        => (string)$stop_names[$index][0],
               'stops_order' => (int)$index
            ]);
        }
    }
}
