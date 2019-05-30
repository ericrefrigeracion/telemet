<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $devices = Device::where('user_id', $user_id)->get();

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
            'id' => 'required|integer|exists:receptions|unique:devices',
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

        if ($user_id === $user_device) {

            return view('devices.show')->with(['device' => $device]);

        }else{
            return "mmm";
        }
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

        if ($user_id === $user_device) {

            return view('devices.edit', compact('device'));

        }else{
            return "mmm";
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

        if ($user_id === $user_device) {

            $rules = [
                'name' => 'required|max:30',
                'cal' => 'required|numeric|min:-5|max:5',
                'min' => 'filled|numeric|min:-30|max:80',
                'max' => 'filled|numeric|min:-30|max:80',
                'dly' => 'filled|integer|min:0|max:60',

            ];

            $request->validate($rules);

            $device->update($request->all());
            return redirect()->route('devices.show', $device->id)->with('info', 'Dispositivo actualizado con exito');

        }else{
            return "mmm";
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

        if ($user_id === $user_device) {

            $device->delete();
            return redirect()->route('devices.index')->with('info', 'Dispositivo eliminado con exito');

        }else{
            return "mmm";
        }
    }

}