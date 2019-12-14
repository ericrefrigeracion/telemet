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

Route::get('/pays/success', 'PayController@success')->name('pays.success');
Route::get('/pays/pending', 'PayController@pending')->name('pays.pending');
Route::get('/pays/failure', 'PayController@failure')->name('pays.failure');

Route::get('/receptions/incoming', 'ReceptionController@store');

Route::middleware(['verified'])->group(function () {

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/info', 'HomeController@info')->name('info');

	Route::prefix('admin')->group(function () {

		//Vue
		Route::get('/vue', function () { return view('vue'); });

		//Users
		Route::get('/users', 'UserController@index')->name('users.index')->middleware('can:users.index');
		Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('can:users.destroy');
		Route::put('/users/{user}', 'UserController@update')->name('users.update')->middleware('can:users.edit');
		Route::get('/users/{user}', 'UserController@show')->name('users.show')->middleware('can:users.show');
		Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('can:users.edit');

		//Roles
		Route::get('/roles', 'RoleController@index')->name('roles.index')->middleware('can:roles.index');
		Route::post('/roles', 'RoleController@store')->name('roles.store')->middleware('can:roles.create');
		Route::get('/roles/create', 'RoleController@create')->name('roles.create')->middleware('can:roles.create');
		Route::delete('/roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('can:roles.destroy');
		Route::put('/roles/{role}', 'RoleController@update')->name('roles.update')->middleware('can:roles.edit');
		Route::get('/roles/{role}', 'RoleController@show')->name('roles.show')->middleware('can:roles.show');
		Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware('can:roles.edit');

		//Permissions
		Route::get('/permissions', 'PermissionController@index')->name('permissions.index')->middleware('can:permissions.index');
		Route::post('/permissions', 'PermissionController@store')->name('permissions.store')->middleware('can:permissions.create');
		Route::get('/permissions/create', 'PermissionController@create')->name('permissions.create')->middleware('can:permissions.create');
		Route::delete('/permissions/{permission}', 'PermissionController@destroy')->name('permissions.destroy')->middleware('can:permissions.destroy');
		Route::put('/permissions/{permission}', 'PermissionController@update')->name('permissions.update')->middleware('can:permissions.edit');
		Route::get('/permissions/{permission}', 'PermissionController@show')->name('permissions.show')->middleware('can:permissions.show');
		Route::get('/permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit')->middleware('can:permissions.edit');

		//Home-all
		Route::get('/home/all', 'HomeController@all')->name('home.all')->middleware('can:home.all');

		//logs
		Route::get('/device-log/{id}', 'DeviceController@log')->name('devices.log')->middleware('can:devices.log');

		//Devices-all
		Route::get('/devices/all', 'DeviceController@all')->name('devices.all')->middleware('can:devices.all');

		//Rules-all
		Route::get('/rules/all', 'RuleController@all')->name('rules.all')->middleware('can:rules.all');

		//Alerts-all
		Route::get('/alerts/all', 'AlertController@all')->name('alerts.all')->middleware('can:alerts.all');

		//Pays-all
		Route::get('/pays/all', 'PayController@all')->name('pays.all')->middleware('can:pays.all');

		//Webhooks
		Route::get('/webhooks', 'WebhookController@index')->name('webhooks.index')->middleware('can:webhooks.index');
		Route::get('/webhooks/{webhook}', 'WebhookController@show')->name('webhooks.show')->middleware('can:webhooks.show');

		//MailAlerts
		Route::get('/mail-alerts', 'MailAlertController@index')->name('mail-alerts.index')->middleware('can:mail-alerts.index');
		Route::get('/mail-alerts/{mail_alert}', 'MailAlertController@show')->name('mail-alerts.show')->middleware('can:mail-alerts.show');

		//Prices
		Route::get('/prices', 'PriceController@index')->name('prices.index')->middleware('can:prices.index');
		Route::post('/prices', 'PriceController@store')->name('prices.store')->middleware('can:prices.create');
		Route::get('/prices/create', 'PriceController@create')->name('prices.create')->middleware('can:prices.create');
		Route::delete('/prices/{price}', 'PriceController@destroy')->name('prices.destroy')->middleware('can:prices.destroy');
		Route::put('/prices/{price}', 'PriceController@update')->name('prices.update')->middleware('can:prices.edit');
		Route::get('/prices/{price}', 'PriceController@show')->name('prices.show')->middleware('can:prices.show');
		Route::get('/prices/{price}/edit', 'PriceController@edit')->name('prices.edit')->middleware('can:prices.edit');

		//TypeDevices
		Route::get('/type-devices', 'TypeDeviceController@index')->name('type-devices.index')->middleware('can:type-devices.index');
		Route::post('/type-devices', 'TypeDeviceController@store')->name('type-devices.store')->middleware('can:type-devices.create');
		Route::get('/type-devices/create', 'TypeDeviceController@create')->name('type-devices.create')->middleware('can:type-devices.create');
		Route::delete('/type-devices/{type_device}', 'TypeDeviceController@destroy')->name('type-devices.destroy')->middleware('can:type-devices.destroy');
		Route::put('/type-devices/{type_device}', 'TypeDeviceController@update')->name('type-devices.update')->middleware('can:type-devices.edit');
		Route::get('/type-devices/{type_device}', 'TypeDeviceController@show')->name('type-devices.show')->middleware('can:type-devices.show');
		Route::get('/type-devices/{type_device}/edit', 'TypeDeviceController@edit')->name('type-devices.edit')->middleware('can:type-devices.edit');

		//Protections
		Route::get('/protections', 'ProtectionController@index')->name('protections.index')->middleware('can:protections.index');
		Route::post('/protections', 'ProtectionController@store')->name('protections.store')->middleware('can:protections.create');
		Route::get('/protections/create', 'ProtectionController@create')->name('protections.create')->middleware('can:protections.create');
		Route::delete('/protections/{protection}', 'ProtectionController@destroy')->name('protections.destroy')->middleware('can:protections.destroy');
		Route::put('/protections/{protection}', 'ProtectionController@update')->name('protections.update')->middleware('can:protections.edit');
		Route::get('/protections/{protection}', 'ProtectionController@show')->name('protections.show')->middleware('can:protections.show');
		Route::get('/protections/{protection}/edit', 'ProtectionController@edit')->name('protections.edit')->middleware('can:protections.edit');

	});

	Route::prefix('centinela')->group(function () {

		//Devices
		Route::get('/devices/info', 'DeviceController@info')->name('devices.info')->middleware('can:devices.info');
		Route::get('/devices', 'DeviceController@index')->name('devices.index')->middleware('can:devices.index');
		Route::post('/devices', 'DeviceController@store')->name('devices.store')->middleware('can:devices.create');
		Route::get('/devices/create', 'DeviceController@create')->name('devices.create')->middleware('can:devices.create');
		Route::delete('/devices/{device}', 'DeviceController@destroy')->name('devices.destroy')->middleware('can:devices.destroy');
		Route::put('/devices/{device}', 'DeviceController@update_device')->name('devices.update_device')->middleware('can:devices.edit');
		Route::put('/devices/tiny-t/{tiny_t_device}', 'DeviceController@update_tiny_t')->name('devices.update_tiny_t')->middleware('can:devices.edit');
		Route::get('/devices/{device}', 'DeviceController@show')->name('devices.show')->middleware('can:devices.show');
		Route::get('/devices/{device}/edit', 'DeviceController@edit')->name('devices.edit')->middleware('can:devices.edit');

		//Receptions
		Route::get('/receptions-now/{device}', 'ReceptionController@now')->name('receptions.now')->middleware('can:receptions.now');
		Route::get('/receptions-today/{device}', 'ReceptionController@today')->name('receptions.today')->middleware('can:receptions.today');
		Route::get('/receptions-yesterday/{device}', 'ReceptionController@yesterday')->name('receptions.yesterday')->middleware('can:receptions.yesterday');
		Route::get('/receptions-week/{device}', 'ReceptionController@week')->name('receptions.week')->middleware('can:receptions.week');

		//Rules
		Route::get('/rules', 'RuleController@index')->name('rules.index')->middleware('can:rules.index');
		Route::post('/rules', 'RuleController@store')->name('rules.store')->middleware('can:rules.create');
		Route::get('/rules/create', 'RuleController@create')->name('rules.create')->middleware('can:rules.create');
		Route::delete('/rules/{rule}', 'RuleController@destroy')->name('rules.destroy')->middleware('can:rules.destroy');
		Route::put('/rules/{rule}', 'RuleController@update')->name('rules.update')->middleware('can:rules.edit');
		Route::get('/rules/{rule}', 'RuleController@show')->name('rules.show')->middleware('can:rules.show');
		Route::get('/rules/{rule}/edit', 'RuleController@edit')->name('rules.edit')->middleware('can:rules.edit');

		//Alerts
		Route::get('/alerts', 'AlertController@index')->name('alerts.index')->middleware('can:alerts.index');
		Route::get('/alerts/{device}', 'AlertController@show')->name('alerts.show')->middleware('can:alerts.show');

	});


		Route::get('/pays/create/{device}', 'PayController@create')->name('pays.create')->middleware('can:pays.create');
	Route::prefix('users')->group(function () {

		//Pays
		Route::get('/pays', 'PayController@index')->name('pays.index')->middleware('can:pays.index');
		Route::get('/pays/{pay}', 'PayController@show')->name('pays.show')->middleware('can:pays.show');
		Route::post('/pays/{device}-{price}', 'PayController@store')->name('pays.store')->middleware('can:pays.create');

		//profile
		Route::get('/profile', 'UserController@show_me')->name('users.show-me')->middleware('can:users.show-me');
		Route::get('/update', 'UserController@edit_me')->name('users.edit-me')->middleware('can:users.edit-me');
		Route::put('/update', 'UserController@update_me')->name('users.update-me')->middleware('can:users.edit-me');

	});

});



