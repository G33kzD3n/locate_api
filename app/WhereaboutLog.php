<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhereaboutLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lat', 'long', 'bus_no'
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

    public function insertWhereaboutsIntoLog($bus_no, $data)
    {
        $this->lat        = $data['lat'];
        $this->long       = $data['long'];
        $this->created_at = $data['time'];
        $this->updated_at = $data['time'];
        $this->bus_no     = $bus_no;
        try {
            $this->save();
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }
}
