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

	Route::prefix('centinela')->namespace('User')->group(function () {

		//Receptions
		Route::prefix('data-receptions')->name('data-receptions.')->group(function () {
			Route::get('{device}', 'DataReceptionController@show')->name('show')->middleware('can:data-receptions.show');
		});

		//Users
		Route::prefix('users')->name('users.')->group(function () {
			Route::get('/', 'UserController@index')->name('index')->middleware('can:users.index');
			Route::post('/', 'UserController@store')->name('store')->middleware('can:users.create');
			Route::get('create', 'UserController@create')->name('create')->middleware('can:users.create');
			Route::delete('{user}', 'UserController@destroy')->name('destroy')->middleware('can:users.destroy');
			Route::put('{user}', 'UserController@update')->name('update')->middleware('can:users.edit');
			Route::get('{user}', 'UserController@show')->name('show')->middleware('can:users.show');
			Route::get('{user}/edit', 'UserController@edit')->name('edit')->middleware('can:users.edit');
		});

		//Rules
		Route::prefix('rules')->name('rules.')->group(function () {
			Route::get('/', 'RuleController@index')->name('index')->middleware('can:rules.index');
			Route::post('/', 'RuleController@store')->name('store')->middleware('can:rules.create');
			Route::get('create', 'RuleController@create')->name('create')->middleware('can:rules.create');
			Route::delete('{rule}', 'RuleController@destroy')->name('destroy')->middleware('can:rules.destroy');
			Route::put('{rule}', 'RuleController@update')->name('update')->middleware('can:rules.edit');
			Route::get('{rule}', 'RuleController@show')->name('show')->middleware('can:rules.show');
			Route::get('{rule}/edit', 'RuleController@edit')->name('edit')->middleware('can:rules.edit');
		});

		//Alerts
		Route::prefix('alerts')->name('alerts.')->group(function () {
			Route::get('/', 'AlertController@index')->name('index')->middleware('can:alerts.index');
			Route::get('{device}', 'AlertController@show')->name('show')->middleware('can:alerts.show');
		});

		//Pays
		Route::prefix('pays')->name('pays.')->group(function () {
			Route::get('create/{device}', 'PayController@create')->name('create')->middleware('can:pays.create');
			Route::get('/', 'PayController@index')->name('index')->middleware('can:pays.index');
			Route::get('/{pay}', 'PayController@show')->name('show')->middleware('can:pays.show');
			Route::post('/{device}-{price}', 'PayController@store')->name('store')->middleware('can:pays.create');
		});

	});

	Route::prefix('users')->namespace('User')->group(function () {
		//profile
		Route::prefix('profile')->name('profile.')->group(function () {
			Route::get('/', 'ProfileController@show')->name('show')->middleware('can:profile.show');
			Route::get('edit', 'ProfileController@edit')->name('edit')->middleware('can:profile.edit');
			Route::put('update', 'ProfileController@update')->name('update')->middleware('can:profile.edit');
			Route::delete('/', 'ProfileController@destroy')->name('destroy')->middleware('can:profile.destroy');
		});
	});

});