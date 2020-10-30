<?php

namespace App\Http\Controllers\User;

use App\Alert;
use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AlertController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $last_day = now()->subDay();
        $alerts = Alert::where('created_at', '>=', $last_day)->latest()->paginate(20);

        return view('alerts.all')->with(['alerts' => $alerts]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Auth::user()->devices()->paginate(10);
        foreach ($devices as $device) {
            $device->alerts_count = Alert::where('device_id', $device->id)->where('created_at', '>', $device->view_alerts_at)->count();
        }

        return view('alerts.index')->with(['devices' => $devices]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        if ($device->users->where('id', Auth::user()->id) || Auth::user()->id < 3) {

            $alerts = Alert::where('device_id', $device->id)->latest()->paginate(20);
            $device->view_alerts_at = now();
            $device->update();

            return view('alerts.show')->with(['device' => $device, 'alerts' => $alerts]);

        }else{
            abort(403, 'Accion no Autorizada');
        }
    }

}