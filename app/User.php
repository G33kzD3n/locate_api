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
        'name', 'username', 'password', 'level', 'phone_no', 'registered_on',
        'avatar', 'semester', 'course_id', 'dept_id', 'bus_no', 'stop_id',
    ];

    protected $guarded = ['id', 'api_token'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'id',
    ];

    /**
     * Refresh the token
     *
     * @return token
     */
    public function generateToken ()
    {
        $this->api_token = str_random(60);
        $this->save();
        return $this->api_token;
    }

    public function updateUserWithoutAvatar ($request, $user)
    {
        try {
            $user->update($request);
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }
    public function updateUserWithAvatar($request,$user){
        try {
            $user->update($request);
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }
    public function stop ()
    {
        return $this->belongsTo(Stop::class);
    }
}
