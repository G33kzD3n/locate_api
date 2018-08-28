<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Show a user resource.
     * @param App\User $user
     * @return Illuminate\Support\Facades\Response
     */
    public function index($user)
    {
        return Response::json(['data'=> $this->userTranform($user)], 200);
    }

    /**
     * Transform the user resouce for api.
     * @param App\user $user.
     * @return array
     */
    protected function userTranform($user)
    {
        return [
                "level"                       => (int) $user->level,
                "name"                        => (string)$user->name,
                "bus_no"                      => (int)$user->bus_no,
                "dept_code"                   => (string)$user->dept_id,
                "course_code"                 => (string)$user->course_id,
                "semester_level"              => (int)$user->semester,
                "avatar"                      => (string)$user->avatar,
                "registration_date"           => (string)$user->registered_on,
                "cell_no"                     => (int)$user->phone_no
        ];
    }
}
