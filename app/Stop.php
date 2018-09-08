<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
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
        'lat', 'long', 'bus_no', 'stops_order', 'name'
    ];

    protected $guarded = ['id'];
}
