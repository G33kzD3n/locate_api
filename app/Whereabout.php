<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

define('_ALREADY_PRESENT_', 1);
class Whereabout extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lat', 'long', 'bus_no', 'status'
    ];
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    /**
     * Store the whereabouts of bus to databse.
     * @throws \PDOException
     * @param INT $bus_no
     * @param Array $data
     * @return Boolean
     **/
    public function store($bus_no, $data)
    {
        if (! $this->recordExists($bus_no) && $this->insertWhereabouts($bus_no, $data)) {
            return "insert";
        }
        $this->updateWhereabouts($bus_no, $data);
        return "update";
    }

    /**
    * Get the whereabouts from databse.
    * @param App\Bus $bus
    * @return App\Whereabout
    **/
    public function getLiveLocation($bus)
    {
        try {
            return \DB::table('whereabouts')->where('bus_no', $bus->bus_no)->first();
        } catch (\Exception $e) {
            throw new \PDOException("Getting live location from whereabouts failed.", 1);
        }
    }

    protected function insertWhereabouts($bus_no, $data)
    {
        $this->lat        = $data['lat'];
        $this->long       = $data['long'];
        $this->created_at = $data['time'];
        $this->updated_at = $data['time'];
        $this->status     = 1;
        $this->bus_no     = $bus_no;
        try {
            $this->save();
        } catch (\Exception $e) {
            throw new \PDOException('Inserting whereabouts failed.', 1);
        }
        return 1;
    }

    protected function recordExists($bus_no)
    {
        try {
            $res = \DB::table('whereabouts')->where('bus_no', $bus_no)->where('status', _ALREADY_PRESENT_)->get();
        } catch (\Exception $e) {
            throw new \PDOException("Finding record in whereabouts failed.", 1);
        }
        if (count($res) == 0) {
            return 0;
        }
        return 1;
    }

    protected function updateWhereabouts($bus_no, $data)
    {
        try {
            \DB::table('whereabouts')->where('bus_no', $bus_no)->where('status', 1)
            ->update(['updated_at' =>$data['time'], 'lat'=>$data['lat'], 'long'=>$data['long']]);
        } catch (\Exception $e) {
            throw new \PDOException("Update whereabouts failed", 1);
        }
    }
}
