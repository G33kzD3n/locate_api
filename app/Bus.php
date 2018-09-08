<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    /**
    * Disable the timestamps.
    */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bus_no', 'gps_device_id'
    ];

    public function getBusNos()
    {
        return \DB::table('buses')->pluck('bus_no');
    }

    public function getStopNames($bus_no)
    {
        $stops =  \DB::table('stops')->select('name', 'lat', 'long')->where('bus_no', $bus_no)
            ->orderBy('stops_order', 'Asc')->get();
        return array_map(function ($stop) {
            return [ $stop->name, $stop->lat, $stop->long];
        }, $stops->toArray());
    }

    public function getCoordinator($bus_no)
    {
        return \DB::table('users')->where('level', '2')->where('bus_no', $bus_no)->first();
    }

    public function getDriver($bus_no)
    {
        return \DB::table('users')->where('level', '1')->where('bus_no', $bus_no)->first();
    }
}
