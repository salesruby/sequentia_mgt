<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/setup', 'SetupController@index');


Route::group(['middleware' => 'admin'], function ($router) {
    Route::post('demo/request', 'DemoController@store');
    Route::get('sequentia/logs', function () {
        return redirect()->to('http://sequentia-api.salesruby.com/api/logs');
    });
});

// Route::post('registration', 'UtilityController@classicForm');
Route::group(['namespace' => 'Auth'], function ($router) {
    Route::group(['prefix'=>'auth'], function ($router) {
        Route::post('login', 'AccessController@login');
        Route::post('logout', 'AccessController@logout');
        Route::post('refresh', 'AccessController@refresh');
        Route::get('me', 'AccessController@me');
        Route::post('reset-password', 'ResetPasswordController@reset');
        Route::post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('store-password/{id}', 'ForgotPasswordController@storeNewPassword');
    });

});
