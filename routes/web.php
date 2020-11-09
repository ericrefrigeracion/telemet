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

Route::get('/', function () { return view('welcome'); });

Route::prefix('pays')->namespace('User')->name('pays.')->group(function () {
	Route::get('success', 'PayController@success')->name('success');
	Route::get('pending', 'PayController@pending')->name('pending');
	Route::get('failure', 'PayController@failure')->name('failure');
});

Route::middleware(['verified'])->group(function () {

	Route::get('home', 'HomeController@index')->name('home');
	Route::get('info', 'HomeController@info')->name('info');
	Route::get('admins/home/all', 'HomeController@all')->name('home.all')->middleware('can:home.all');

});



