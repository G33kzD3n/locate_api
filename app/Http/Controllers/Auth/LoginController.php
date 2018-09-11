<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @param App\User $user .
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Create the validator for data.
     *
     * @param array $data .
     *
     * @return Illuminate\Support\Facades\Validator
     */
    protected function validateLoginCreds(array $data)
    {
        return Validator::make(
            $data,
            [
                'username'    => 'required|numeric|digits_between:11,11',
                'password'    => 'required|date_format:"Y-m-d"',
            ]
        );
    }

    /**
     * Attempt user login with passed creds.
     *
     * @param Illuminate\Http\Request $request .
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function login(Request $request)
    {
        $validator = $this->validateLoginCreds($request->all());
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 404);
        }
        if (auth()->attempt($request->all())) {
            $user = $this->guard()->user();
            $user->generateToken();
            return Response::json(
                [
                    'data' => $this->userTranform($user)
                ],
                201
            );
        } else {
            return Response::json(
                [
                    'error' =>
                        [
                           'error_code'   => 'authentication_error',
                           'error_message'=> 'Authentication Error occurs when the credentials do not match any database resource.',
                        ]
                ],
                401
            );
        }
    }

    /**
     * Transform user object.
     *
     * @param App\User $user .
     *
     * @return array
     */
    protected function userTranform($user)
    {
        return [
              'bus_no'  => (int)$user->bus_no,
              'token'   => (string)$user->api_token,
              'level'   => (int)$user->level
            ];
    }
}
