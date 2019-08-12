<?php

use App\Weather;
use Illuminate\Http\Request;
use App\Http\Controllers\WeatherController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('weather/', 'WeatherController@index');

Route::get('weather/{city}', 'WeatherController@show');

Route::post('weather/', 'WeatherController@store');
