<?php

use App\Alert;
use App\MailAlert;

function setActive($routeName) {

	return request()->routeIs($routeName) ? 'active' : '' ;

}

function alertCreate($device, $log, $moment)
{
    Alert::create([
        'device_id' => $device->id,
        'log' => $log,
        'alert_created_at' => $moment,
    ]);
}

function mailAlertCreate($device, $type, $moment)
{
    MailAlert::create([
        'device_id' => $device->id,
        'user_id' => $device->users()->first()->id,
        'type' => $type,
        'last_created_at' => $moment,
    ]);
}