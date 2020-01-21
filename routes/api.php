<?php

use Illuminate\Http\Request;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 */
Route::post('store', 'EmployeesController@store')->name('store');
Route::get('show', 'EmployeesController@show')->name('show');
//Route::get('get/{id}', 'EmployeesController@getOne')->name('getOne');
Route::put('update/{id}', 'EmployeesController@update')->name('update');
Route::delete('destroy/{id}', 'EmployeesController@destroy')->name('destroy');

