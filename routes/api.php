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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('centinela/receptions')->namespace('Api')->name('receptions.')->group(function () {
	Route::get('now/{device}/{topic}', 'DataController@now')->name('now');
	Route::get('data/{device}/{topic}/{month}/{day}', 'DataController@data')->name('data');
});

Route::post('/webhooks', 'Admin\WebhookController@ipn');
Route::post('/webhooks/{user_id}-{device_id}-{price_id}', 'Admin\WebhookController@pay');

//Route::get('/receptions/last-hour/{device}', 'Api\ReceptionController@last_hour');
//Route::get('/receptions/live/{device}', 'Api\ReceptionController@live');
//Route::get('/devices/all', 'Api\DeviceController@all');



