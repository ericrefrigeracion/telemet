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

Route::post('/webhooks', 'WebhookController@ipn');
Route::post('/webhooks/sms', 'WebhookController@sms');
Route::post('/webhooks/{user_id}-{device_id}-{price_id}', 'WebhookController@pay');

Route::get('/receptions/last-hour/{device}', 'Api/ReceptionController@last_hour');
Route::get('/receptions/live/{device}', 'Api/ReceptionController@live');
Route::get('/devices/all', 'Api/DeviceController@all');
Route::get('/devices/tiny-pump/{user}', 'Api/DeviceController@tiny_pump_index');
Route::get('/devices/tiny-t/{user}', 'Api/DeviceController@tiny_t_index');



