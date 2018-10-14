<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    // public function __construct(Admin $admin)
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    // public function login(Request $request)
    // {
    //     $validator = $this->validateLoginCreds($request->all());
    //     if ($validator->fails()) {
    //         return Response::json(['errors' => $validator->errors()], 404);
    //     }
    //     if (auth()->attempt($request->all())) {
    //         $user = $this->guard()->user();
    //         $user->generateToken();
    //         return Response::json(
    //             [
    //                 'data' => $this->userTranform($user)
    //             ],
    //             201
    //         );
    //     } else {
    //         return Response::json(
    //             [
    //                 'error' =>
    //                     [
    //                        'error_code'   => 'authentication_error',
    //                        'error_message'=> 'Authentication Error occurs when the credentials do not match any database resource.',
    //                     ]
    //             ],
    //             401
    //         );
    //     }
    // }
}
