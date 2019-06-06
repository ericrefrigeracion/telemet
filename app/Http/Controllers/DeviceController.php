<?php

namespace App\Http\Controllers;

use App\Device;
use App\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $devices = Device::paginate(20);

        return view('devices.all')->with(['devices' => $devices]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $devices = Device::where('user_id', $user_id)->paginate(10);

        return view('devices.index')->with(['devices' => $devices]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'id' => 'required|integer|unique:devices,id',
            'name' => 'required|max:30',
        ];

        $request->validate($rules);

        $device = new Device;
        $device->id = $request->id;
        $device->name = $request->name;
        $device->user_id = Auth::user()->id;
        $device->save();

        return redirect()->route('devices.show', $request->id)->with('info', 'Dispositivo creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {

        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2) {

            return view('devices.show')->with(['device' => $device]);

        }else{
            abort(403, 'Accion no Autorizada');
        }
    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function log($id)
    {
        $device = Device::findOrFail($id);
        $device_logs = Reception::where('device_id', $id)->where('log', '!=', 200)->paginate(20);

        return view('devices.log')->with(['device_logs' => $device_logs, 'device' => $device]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2) {

            return view('devices.edit', compact('device'));

        }else{
            abort(403, 'Accion no Autorizada');
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2) {

            $rules = [
                'name' => 'required|max:30',
                'cal' => 'required|numeric|min:-5|max:5',
                'mon' => 'boolean',
                'min' => 'filled|numeric|min:-30|max:80',
                'max' => 'filled|numeric|min:-30|max:80',
                'dly' => 'filled|integer|min:0|max:60',

            ];

            $request->validate($rules);

            $device->update($request->all());
            return redirect()->route('devices.show', $device->id)->with('info', 'Dispositivo actualizado con exito');

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
    public function destroy(Device $device)
    {
        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2) {

            $device->delete();
            return redirect()->route('devices.index')->with('info', 'Dispositivo eliminado con exito');

        }else{
            abort(403, 'Accion no Autorizada');
        }
    }

}