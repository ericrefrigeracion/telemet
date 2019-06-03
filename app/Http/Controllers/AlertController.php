<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Device;
use Illuminate\Http\Request;

class AlertController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {

        $alerts = Alert::where('device_id', $device->id)->paginate(20);

        return view('alerts.show')->with(['device' => $device, 'alerts' => $alerts]);

    }


}
