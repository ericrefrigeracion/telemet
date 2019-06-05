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
Auth::routes();

Route::get('/', function () { return view('welcome'); });
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/receptions/incoming', 'ReceptionController@store');

Route::prefix('/admin')->middleware('verified')->group(function () {

	//Users
	Route::get('/users', 'UserController@index')
		->name('users.index')->middleware('can:users.index');
	Route::delete('/users/{user}', 'UserController@destroy')
		->name('users.destroy')->middleware('can:users.destroy');
	Route::put('/users/{user}', 'UserController@update')
		->name('users.update')->middleware('can:users.edit');
	Route::get('/users/{user}', 'UserController@show')
		->name('users.show')->middleware('can:users.show');
	Route::get('/users/{user}/edit', 'UserController@edit')
		->name('users.edit')->middleware('can:users.edit');

	//Roles
	Route::get('/roles', 'RoleController@index')
		->name('roles.index')->middleware('can:roles.index');
	Route::post('/roles', 'RoleController@store')
		->name('roles.store')->middleware('can:roles.create');
	Route::get('/roles/create', 'RoleController@create')
		->name('roles.create')->middleware('can:roles.create');
	Route::delete('/roles/{role}', 'RoleController@destroy')
		->name('roles.destroy')->middleware('can:roles.destroy');
	Route::put('/roles/{role}', 'RoleController@update')
		->name('roles.update')->middleware('can:roles.edit');
	Route::get('/roles/{role}', 'RoleController@show')
		->name('roles.show')->middleware('can:roles.show');
	Route::get('/roles/{role}/edit', 'RoleController@edit')
		->name('roles.edit')->middleware('can:roles.edit');

	//logs
	Route::get('/device-log/{id}', 'DeviceController@log')
		->name('devices.log')->middleware('can:devices.log');

	//Devices-all
	Route::get('/devices-all', 'DeviceController@all')
		->name('devices.all')->middleware('can:devices.all');

	//Alerts
	Route::get('/alerts/{device}', 'AlertController@show')
		->name('alerts.show')->middleware('can:alerts.show');


});

Route::prefix('/centinela')->middleware('verified')->group(function () {

	//Devices
	Route::get('/devices', 'DeviceController@index')
		->name('devices.index')->middleware('can:devices.index');
	Route::post('/devices', 'DeviceController@store')
		->name('devices.store')->middleware('can:devices.create');
	Route::get('/devices/create', 'DeviceController@create')
		->name('devices.create')->middleware('can:devices.create');
	Route::delete('/devices/{device}', 'DeviceController@destroy')
		->name('devices.destroy')->middleware('can:devices.destroy');
	Route::put('/devices/{device}', 'DeviceController@update')
		->name('devices.update')->middleware('can:devices.edit');
	Route::get('/devices/{device}', 'DeviceController@show')
		->name('devices.show')->middleware('can:devices.show');
	Route::get('/devices/{device}/edit', 'DeviceController@edit')
		->name('devices.edit')->middleware('can:devices.edit');

	//Receptions
	Route::get('/receptions/{device}', 'ReceptionController@show')
		->name('receptions.show')->middleware('can:receptions.show');

});
