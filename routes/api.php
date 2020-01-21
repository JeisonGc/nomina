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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::resource('users', 'UserController');
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::resource('users', 'UserController');
    Route::resource('parameters', 'ParametersController');        
    Route::resource('solidarityFund', 'SolidarityFundController');
    Route::resource('riskClass', 'RiskClassController');
    Route::resource('novelties', 'NoveltiesController');
});
//Route::get('parameters', 'ParametrosController@index')->name('parameters');