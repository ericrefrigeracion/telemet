<?php

use App\Alert;
use App\MailAlert;

function setActive($routeName) {

	return request()->routeIs($routeName) ? 'active' : '' ;

}

function AlertCreate($device, $log, $moment)
{
    Alert::create([
        'device_id' => $device->id,
        'log' => $log,
        'alert_created_at' => $moment,
    ]);
}

function MailAlertCreate($device, $type, $moment)
{
    MailAlert::create([
        'device_id' => $device->id,
        'user_id' => $device->user_id,
        'type' => $type,
        'last_created_at' => $moment,
    ]);
}
