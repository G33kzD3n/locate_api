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

Route::get(
    '/user',
    function () {
        return response(["name"=>"nadeem"], 201);
    }
);

Route::post('/1.0/login', 'Auth\LoginController@login');
