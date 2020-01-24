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
});

Route::group([
    'middleware' => ['api']
], function ($router) {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('parameters', 'ParametersController');
    Route::resource('settlements', 'SettlementsController');
    Route::resource('solidarity-fund', 'SolidarityFundController');
    Route::resource('risk-class', 'RiskClassController');
    Route::resource('novelties', 'NoveltiesController');
    Route::resource('employees', 'EmployeesController');
    Route::resource('type-contracts', 'TypeContractController');
    Route::resource('loans', 'LoanController');
});
