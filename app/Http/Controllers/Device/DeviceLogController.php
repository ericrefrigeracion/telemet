<?php

namespace App\Http\Controllers\Device;

use App\Device;
use App\DeviceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DeviceLogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Auth::user()->devices()->paginate(10);

        foreach ($devices as $device) $device->device_logs_count = $device->device_logs()->count();

        return view('device-logs.index')->with(['devices' => $devices]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $device = Device::findOrFail($request->device_id);

        if ($user->id === $device->user_id || Auth::user()->id < 3)
        {
            $rules = [
                'content' => 'required|string'
            ];

            $request->validate($rules);

            DeviceLog::create([
                'user_name' => $user->name,
                'content' => $request->content,
                'device_id' => $device->id
            ]);

            return redirect()->route('device-logs.show', $device->id)->with('success', ['Informacion de dispositivo creada con exito.']);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3) {

            $device_logs = $device->device_logs()->get();

            return view('device-logs.show')->with(['device' => $device, 'device_logs' => $device_logs]);

        }else{
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeviceLog $device_log)
    {
        $user = Auth::user();
        $device = $device_log->device();

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $device_log->delete();
            return redirect()->route('devices.index')->with('success', ['Informacion de dispositivo eliminada con exito']);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

}
