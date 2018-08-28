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
//authenticated routes
Route::group(['prefix' => '/1.0', 'middleware' =>'auth:api'], function () {
    //user profile
    Route::get('/users/{username}', 'UserController@index');
});


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

Route::get(
    '/user',
    function () {
        return response(["name"=>"nadeem"], 201);
    }
);
