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

use Illuminate\Support\Facades\Redis;

Route::post('/1.0/login', 'Auth\LoginController@login');

Route::get('/1.0/users/{username}', 'UserController@index');
Route::get('/1.0/users/{username}/fees/unpaid', 'UserController@showUnPaid');

Route::get('/1.0/buses', 'BusController@index');
Route::get('/1.0/buses/{bus}', 'BusController@show');
Route::get('/1.0/buses/{bus}/passengers', 'BusController@showpassengers');

Route::get('/1.0/buses/{bus}/location', 'WhereaboutController@location');
Route::post('/1.0/buses/{bus}/store', 'WhereaboutController@store');
Route::get('/redis', function () {
    $options = [
    'cluster' => 'ap2',
    'useTLS'  => true
  ];
    $pusher = new Pusher\Pusher(
    'fc44950e09ecefa9effd',
    '662ca14e981599989a96',
    '603415',
    $options
  );
    $data['message'] = 'hello world';

    // $pusher->trigger('my-channel', 'my-event', $data);
    $pusher->trigger('my-channel', 'my-event', ['data' =>"nadeem"]);
    $pusher->trigger('my-channel', 'my-event', ['data' =>"nadeem"]);
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
        return \DB::table('users')->orderBy('level', 'desc')->get();
    }
);
