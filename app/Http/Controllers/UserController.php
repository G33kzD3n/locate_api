<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *');


class UserController extends Controller
{
    public function login(Request $data)
    {
        $user_id  = 1111111111;
        $password = 1111111111;


        if ($data['phone'] == $user_id && $data['roll'] == $password) {
            $data = [
                'data'=> [
                        'useranme' => $data['username'],
                        'password' => $data['password'],
                        'status'   => [

                        'response_code' => 200,
                        'status'        => 'sucess'
                    ]
                ]
            ];

            return response($data, 200);
        } else {
            $data = [
                    'error' => [
                        'error_message'    => "Creds dont match?",
                        'status'           => "error"]];
            return response($data, 401);
        }
    }
}
