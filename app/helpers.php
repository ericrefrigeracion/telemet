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
        'user_id' => $device->user_id,
        'type' => $type,
        'last_created_at' => $moment,
    ]);
}

function sendWhatsApp()
{
    $INSTANCE_ID = 'YOUR_INSTANCE_ID_HERE';  // TODO: Replace it with your gateway instance ID here
    $CLIENT_ID = "YOUR_CLIENT_ID_HERE";  // TODO: Replace it with your Forever Green client ID here
    $CLIENT_SECRET = "YOUR_CLIENT_SECRET_HERE";   // TODO: Replace it with your Forever Green client secret here
    $postData = array(
      'number' => '543385470666',  // TODO: Specify the recipient's number here. NOT the gateway number
      'message' => 'Esto es una locura'
    );
    $headers = array(
      'Content-Type: application/json',
      'X-WM-CLIENT-ID: '.$CLIENT_ID,
      'X-WM-CLIENT-SECRET: '.$CLIENT_SECRET
    );
    $url = 'http://api.whatsmate.net/v3/whatsapp/single/text/message/' . $INSTANCE_ID;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    $response = curl_exec($ch);
    echo "Response: ".$response;
    curl_close($ch);
}