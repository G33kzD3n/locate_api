<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/1.0/login', 'Auth\LoginController@login');



/*
|--------------------------------------------------------------------------
| Testing Routes
|--------------------------------------------------------------------------
*/
//to view all users in database.
//e.g 1.0/users
Route::get(
    '/1.0/users',
    function () {
        return \App\User::all();
    }
);

//to view a user by username
// e.g 1.0/users/15045112037
Route::get(
    '/1.0/users/{username}',
    function ($username) {
        $user = \DB::table('users')->where('username', $username)->first();
        if (!$user) {
            return response()->json(
                [
                    'errors' => [
                        'message' => "No user found"
                    ]
                ],
                404
            );
        }
        return response()->json(
            [
                $user
            ],
            200
        );
    }
);


Route::get(
    '/user',
    function () {
        return response(["name"=>"nadeem"], 201);
    }
);
