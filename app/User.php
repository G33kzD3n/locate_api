<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'username', 'password', 'level'
    ];

    protected $guarded = ['id', 'token'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Refresh the token
     *
     * @return token
     */
    public function generateToken()
    {
        $this->token = str_random(60);
        $this->save();
        return $this->token;
    }

    /**
     * Returns the bus_no assigned to this user
     *
     * @return busno
     */
    public function getBusNo()
    {
        return 8840;
    }
}
