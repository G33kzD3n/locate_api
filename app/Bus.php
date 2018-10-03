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

    public function getPassengers($bus_no)
    {
        return \DB::select("SELECT u.name as uname, u.username, u.dept_id, u.course_id,u.bus_no,u.phone_no, u.level ,
            u.semester,u.avatar,s.name as stopname, s.lat, s.long, s.stops_order
            FROM users as u JOIN stops as s ON s.id = u.stop_id
            WHERE u.level IN ('0','2') AND u.bus_no = ? ORDER BY s.stops_order ASC", [$bus_no]);
    }

    public function getCoordinator($bus_no)
    {
        return \DB::table('users')->where('level', '2')->where('bus_no', $bus_no)->first();
    }

    public function getDriver($bus_no)
    {
        return \DB::table('users')->where('level', '1')->where('bus_no', $bus_no)->first();
    }

    public function getPassengersByStopNames($bus_no)
    {
        //yet to be completed
    }
}
