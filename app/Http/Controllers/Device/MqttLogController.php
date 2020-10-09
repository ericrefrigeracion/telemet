<?php

namespace App\Http\Controllers\Device;

use App\Device;
use App\MqttLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MqttLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::all();

        foreach ($devices as $device) $device->mqtt_logs_count = $device->mqtt_logs()->count();

        return view('mqtt-logs.index', compact('devices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MqttLog  $mqttLog
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        $mqtt_logs = $device->mqtt_logs()->get();
        return view('mqtt-logs.show', compact('device', 'mqtt_logs'));
    }
}
