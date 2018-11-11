<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title', 'body', 'created_at', 'updated_at'
    ];
    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    public function saveNotification($data)
    {
        try {
            $this->title       = $data['subject'];
            $this->body        = $data['message'];
            $this->created_at  = $data['time'];
            $this->updated_at  = $data['time'];
            $this->save();
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
        return 1;
    }
}
