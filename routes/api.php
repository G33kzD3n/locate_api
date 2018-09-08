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

Route::get('/1.0/users/{username}', 'UserController@index');
Route::get('/1.0/users/{username}/fees/unpaid', 'UserController@showUnPaid');

Route::get('/1.0/buses', 'BusController@index');
Route::get('/1.0/buses/{bus}', 'BusController@show');

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
        return \DB::table('users')->orderBy('level', 'desc')->get();
    }
);
