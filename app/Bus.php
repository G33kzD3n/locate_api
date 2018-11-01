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
        'bus_no', 'gps_device_id',
    ];

    public function store (array $data)
    {
        try {
            $this->bus_no = $data['bus_no'];
            $this->gps_device_id = $data['gps_device_id'];
            $this->save();
            return $this;
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }
    public function deleteBus($bus){
        try{
            return \DB::table('buses')->where('bus_no', '=', $bus->bus_no)->delete();
        }catch(\Exception $e){
            throw new \PDOException($e->getMessage(), 1);
        }
    }
    public function updateBus ($bus,array $data)
    {
        try{
            \DB::table('buses')->where('bus_no', $bus->bus_no)
                ->update(['bus_no' =>$data['bus_no'], 'gps_device_id'=>$data['gps_device_id']]);
            return $bus;
        }catch(\Exception $e){
            throw new \PDOException($e->getMessage(), 1);
        }
    }

    public function getBusNos ()
    {
        try {
            return \DB::table('buses')->pluck('bus_no');
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }

    public function getStopNames ($bus_no)
    {
        try {
            $stops = \DB::table('stops')->select('name', 'lat', 'long')->where('bus_no', $bus_no)
                ->orderBy('stops_order', 'Asc')->get();
            if(count($stops->toArray())==0){
                return null;
            }else{
                return array_map(function ($stop) {
                    return [$stop->name, $stop->lat, $stop->long];
                }, $stops->toArray());
            }
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }

    public function getPassengers ($bus_no)
    {
        try {
            return \DB::select("SELECT u.name as uname, u.username, u.dept_id, u.course_id,u.bus_no,u.phone_no, u.level ,
            u.semester,u.avatar,s.name as stopname, s.lat, s.long, s.stops_order
            FROM users as u JOIN stops as s ON s.id = u.stop_id
            WHERE u.level IN ('0','2') AND u.bus_no = ? ORDER BY s.stops_order ASC", [$bus_no]);
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }

    public function getCoordinator ($bus_no)
    {
        try {
            $coordinator = \DB::table('users')->where('level', '2')->where('bus_no', $bus_no)->first();
//            print_r($coordinator);
            if($coordinator == null){
                return null;
            }else{
                return $coordinator;
            }
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }

    public function getDriver ($bus_no)
    {
        try {
            $driver =  \DB::table('users')->where('level', '1')->where('bus_no', $bus_no)->first();
            if($driver == null){
                return $driver;
            }else{
                return $driver;
            }
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }

    public function getPassengersOfStop ($id)
    {
        try {
            return \DB::select("SELECT  u.name, u.username, u.dept_id, u.course_id,u.bus_no,u.phone_no, u.level ,
            u.semester,u.avatar FROM users as u WHERE u.level IN ('0','2') AND u.stop_id = ? ORDER BY u.stop_id ASC", [$id]);
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }

    public function getStopIds ($bus_no)
    {
        try {
            return \DB::table('stops')->where('bus_no', $bus_no)->orderBy('stops_order', 'ASC')->pluck('id')->toArray();
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }

    public function getStops ($bus_no)
    {
        try {
            $stops = \DB::table('stops')->select('stops_order', 'name', 'lat', 'long')->where('bus_no', $bus_no)
                ->orderBy('stops_order', 'Asc')->get();
            return array_map(function ($stop) {
                return ['stop_no' => $stop->stops_order, 'name' => $stop->name, 'lat' => $stop->lat, 'lng' => $stop->long];
            }, $stops->toArray());
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }
}
