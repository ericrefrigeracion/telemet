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
Route::post('/webhooks/{user_id}-{device_id}-{price_id}', 'WebhookController@pay');
Route::get('/receptions/incoming', 'ReceptionController@store');


