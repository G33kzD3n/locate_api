<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Stop;
use App\User;

class UserController extends Controller
{
    /**
     * Show a user resource.
     * @param User $user
     * @return Illuminate\Support\Facades\Response
     */
    public function index ($user)
    {
        return response()->json(['data' => $this->userTranform($user)], 200);
    }

    public function edit ($user)
    {
        return $user;
    }

    public function showUnPaid ($user)
    {
        $feeModel = new Fee();
        $result = $feeModel->unPaid($user);
        $filteredData = [
            'name' => $result->name,
            'monthly_fee' => (int)$result->monthly_fee,
            'unpaid_months' => (int)$result->un_paid_months,
            'total_unpaid_fee' => (int)$result->total_amount,
        ];

        return response()->json(['data' => $filteredData], 201);
    }

    /**
     * Transform the user resource for api.
     * @param App\User $user .
     * @return array
     */
    protected function userTranform ($user)
    {
        return [
            "level" => (int)$user->level,
            "name" => (string)$user->name,
            "bus_no" => (int)$user->bus_no,
            "dept_code" => (string)$user->dept_id,
            "course_code" => $user->course_id,
            "semester_level" => $user->semester,
            "avatar" => (string)$user->avatar,
            "registration_date" => (string)$user->registered_on,
            "cell_no" => (int)$user->phone_no,
            "stop" => $user->stop != null ? [
                'name' => $user->stop->name,
                'lat' => (double)$user->stop->lat,
                'lng' => (double)$user->stop->long,
                'stop_no' => (int)$user->stop->stops_order,
            ] : null,
        ];
    }
}
