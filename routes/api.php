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
Route::get('/1.0/buses/{bus}/passengers', 'BusController@showPassengers');

Route::get('/1.0/buses/{bus}/location', 'WhereaboutController@location');
Route::post('/1.0/buses/{bus}/store', 'WhereaboutController@store');
Route::post('/1.0/buses/{bus}/breakdown', 'BreakdownController@store');
Route::put('1.0/buses/{bus}/breakdowns/{breakdown}', 'BreakdownController@update');


/*
 * Route for admin.
 **/
Route::group(['prefix' => 'admin'], function () {
    Route::post('/1.0/login', 'Auth\AdminLoginController@login');
});

/*
 * Authenticated route groups for admin
 **/
Route::group(['prefix' => 'admin', 'middleware' => 'admin:admin'], function () {
    //store,edit,delete bus api.
    Route::post('/1.0/buses/create','BusController@store');
    Route::put('1.0/buses/{bus}/edit','BusController@edit');
    Route::delete('1.0/buses/{bus}/delete','BusController@delete');

    //edit existing users
    Route::patch('1.0/users/{username}/edit','UserController@edit');
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
