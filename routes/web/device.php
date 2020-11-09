<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function () {

	Route::prefix('centinela')->namespace('Device')->group(function () {

		//Devices
		Route::prefix('devices')->name('devices.')->group(function () {
			Route::get('/', 'DeviceController@index')->name('index')->middleware('can:devices.index');
			Route::post('/', 'DeviceController@store')->name('store')->middleware('can:devices.create');
			Route::get('create', 'DeviceController@create')->name('create')->middleware('can:devices.create');
			Route::delete('{device}', 'DeviceController@destroy')->name('destroy')->middleware('can:devices.destroy');
			Route::put('{device}', 'DeviceController@update')->name('update')->middleware('can:devices.edit');
			Route::get('{device}', 'DeviceController@show')->name('show')->middleware('can:devices.show');
			Route::get('{device}/edit', 'DeviceController@edit')->name('edit')->middleware('can:devices.edit');
			Route::get('{device}/configuration', 'DeviceController@configuration')->name('configuration')->middleware('can:devices.configuration');
		});

		//Device-configurations
		Route::put('/device-configurations/{device_configuration}', 'DeviceConfigurationController@update')->name('device-configurations.update')->middleware('can:devices.configuration');

		//Device-Logs
		Route::prefix('device-logs')->name('device-logs.')->group(function () {
			Route::get('/', 'DeviceLogController@index')->name('index')->middleware('can:device-logs.index');
			Route::post('/', 'DeviceLogController@store')->name('store')->middleware('can:device-logs.create');
			Route::get('{device}', 'DeviceLogController@show')->name('show')->middleware('can:device-logs.show');
			Route::delete('{device_log}', 'DeviceLogController@destroy')->name('destroy')->middleware('can:device-logs.destroy');
		});

	});

});