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
Route::post('/add', 'EmployeesController@add')->name('add');
Route::get('/list', 'EmployeesController@getAll')->name('getAll');
Route::get('/get/{id}', 'EmployeesController@getOne')->name('getOne');
Route::put('/get/{id}', 'EmployeesController@update')->name('update');
Route::delete('/delete/{id}', 'EmployeesController@destroy')->name('destroy');

