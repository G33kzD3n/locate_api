<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct (Admin $admin)
    {
        // $this->middleware('guest')->except('logout');
    }

    public function login (Request $request)
    {
        $validator = $this->validateLoginCreds($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 404);
        }
        $admin = Admin::where('username', $request->username)->first();
        if (!$admin) {
            return redirect($this->loginPath)->with('error', 'Admin bulunamadi.');
        }
        if (\Hash::check($request->password, $admin->password)) {
            return response()->json(
                [
                    'data' => $admin,
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'error' =>
                        [
                            'error_code' => 'authentication_error',
                            'error_message' => 'Authentication Error occurs when the credentials do not match any database resource.',
                        ],
                ],
                401
            );
        }
    }

    protected function validateLoginCreds (array $data)
    {
        return Validator::make(
            $data,
            [
                'username' => 'required|string',
                'password' => 'required|string',
            ]
        );
    }

    // protected attemptAdminlogin(){

    // }
    // protected function guard()
    // {
    //     return auth('admin');
    // }
}
