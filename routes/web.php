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

Route::get('/', function () {return view('welcome');});
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('devices', 'DeviceController');
Route::resource('receptions', 'ReceptionController')->only(['show']);
Route::resource('device-configurations', 'DeviceConfigurationController')->only(['edit', 'update']);
Route::resource('user-informations', 'UserInformationController')->only(['edit', 'update']);