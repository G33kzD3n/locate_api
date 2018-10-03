<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breakdown extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'bus_no', 'type', 'message', 'created_at', 'updated_at'
    ];
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    public function storeBreakdownInfo($bus_no, $data)
    {
        $this->bus_no     = $bus_no;
        $this->type       =$data['type'];
        $this->created_at = $data['time'];
        $this->updated_at = $data['time'];
        try {
            $this->save();
        } catch (\Exception $e) {
            throw new \PDOException('Inserting breakdown failed.', 1);
        }
        return $this->id;
    }

    public function updateBreakdownInfo($instance, $data)
    {
        try {
            $instance->message    =$data['message'];
            $instance->created_at =$data['time'];
            $instance->save();
        } catch (\Exception $e) {
            throw new \PDOException('Updating breakdown message failed.', 1);
        }
        return 1;
    }
}
