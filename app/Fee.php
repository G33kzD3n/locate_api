<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
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
        'username', 'due_date', 'paid'
    ];

    protected $guarded = ['id', 'fee'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    public function unPaid($user)
    {
        // SELECT username, fee as 'Monthly Fee', count(username) as 'Total Unpaid Months', sum(fee) as 'Total Amount to be paid' FROM fees WHERE paid = 0 GROUP By username ORDER BY sum(fee) desc
        try {
            $res = DB::select('SELECT u.name , f.username , f.fee as monthly_fee, COUNT(f.username) as un_paid_months, SUM(f.fee) as total_amount FROM fees as f
        INNER JOIN users as u ON u.username = f.username WHERE f.paid = 0  and f.username = ? GROUP BY f.username ORDER By total_amount desc', [$user->username]);
            if (!count($res)) {
                abort(404);
            }
            return $res[0];
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage(), 1);
        }
    }
}
