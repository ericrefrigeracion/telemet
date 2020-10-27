<?php

namespace App\Http\Controllers\Device;

use App\Pay;
use App\User;
use App\Alert;
use App\Icon;
use App\Price;
use App\Device;
use App\DeviceUser;
use App\Protection;
use App\TypeDevice;
use App\DeviceConfiguration;
use App\TypeDeviceConfiguration;
use App\Reception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateDeviceRequest;
use App\Http\Controllers\Controller;

class DeviceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return view('devices.all');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Auth::user()->devices;
        return view('devices.index', compact('devices'));
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
    public function store(CreateDeviceRequest $request)
    {

        $type_device = TypeDevice::where('prefix', $request->prefix)->first();
        $user = Auth::user();

        Device::create([
            'id' => $request->id,
            'type_device_id' => $type_device->id,
            'protection_id' => 1,
            'icon_id' => 1,
            'status_id' => 1,
            'name' => $request->name,
            'description' => $request->description,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'notification_email' => $user->email,
            'notification_phone_number' => $user->phone_area_code . ' - ' . $user->phone_number,
            'monitor_expires_at' => now()->addDays(60),
            'view_alerts_at' => now(),
        ]);

        $type_device_configurations = TypeDeviceConfiguration::where('type_device_id', $type_device->id)->get();
        foreach($type_device_configurations as $type_device_configuration){
            DeviceConfiguration::create(['device_id' => $request->id,
                                        'topic_id' => $type_device_configuration->topic_id,
                                        'topic_control_type_id' => $type_device_configuration->topic_control_type_id,
                                        'value' => $type_device_configuration->topic_control_type->default,
                                        'status' => 'ok',
                                        'status_at' => now()
                                    ]);

        }

        $user->devices()->attach($request->id);

        alertCreate($request, Auth::user()->name . ' agrego dispositivo con exito.', now());

        return redirect()->route('devices.show', $request->id)->with('success', ['Dispositivo creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {

        if ($device->users->where('id', Auth::user()->id) || Auth::user()->id < 3)
        {

            return view('devices.show')->with(['device' => $device]);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
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
        if ($device->users->where('id', Auth::user()->id) || Auth::user()->id < 3)
        {
            $protections = Protection::pluck('description', 'id')->all();
            $icons = Icon::where('type', 'device')->pluck('name', 'id')->all();
            $emails = $device->users->pluck('name', 'email')->all();
            $phones = $device->users->pluck('name', 'phone_number')->all();
            return view('devices.edit', compact('icons', 'device', 'protections', 'phones', 'emails'));
        }
        else
        {
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

        if ($device->users->where('id', Auth::user()->id) || Auth::user()->id < 3)
        {
            $rules = [
                'protection_id' => 'required|exists:protections,id',
                'name' => 'required|max:25',
                'description' => 'max:50',
                'notification_email' => 'required|string',
                'notification_phone_number' => 'required',
                'icon_id' => 'filled|exists:icons,id'
            ];

            $request->validate($rules);

            if($device->protection_id != 1 && $request->protection_id == 1)
            {
                $request['protected'] = true;
            }

            if($device->protection_id != 4 && $request->protection_id == 4) $request['protected'] = false;

            if($request->has('protection_id') && $request->protection_id != $device->protection_id) alertCreate($device, Auth::user()->name . " cambio el tipo de proteccion a $request->protection_id .", now());
            if($request->has('name') && $request->name != $device->name) alertCreate($device, Auth::user()->name . " cambio el nombre de dispositivo a $request->name .", now());
            if($request->has('description') && $request->description != $device->description) alertCreate($device, Auth::user()->name . " cambio la descripcion de dispositivo a $request->description .", now());
            if($request->has('notification_email') && $request->notification_email != $device->notification_email) alertCreate($device, Auth::user()->name . " cambio el E-mail de notificacion a $request->notification_email .", now());
            if($request->has('notification_phone_number') && $request->notification_phone_number != $device->notification_phone_number) alertCreate($device, Auth::user()->name . " cambio numero de notificacion a $request->notification_phone_number", now());

            $device->update($request->all());

            return redirect()->route('devices.show', $device->id)->with('success', ['Dispositivo actualizado con exito']);

        }
        else
        {
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

        if ($device->users->where('id', Auth::user()->id) || Auth::user()->id < 3)
        {
            $device->delete();
            return redirect()->route('devices.index')->with('success', ['Dispositivo eliminado con exito']);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    public function configuration(Device $device)
    {
        if ($device->users->where('id', Auth::user()->id) || Auth::user()->id < 3)
        {

            return view('devices.configuration', compact('device'));
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    public function mqtt_log(Device $device)
    {
        $mqtt_logs = $device->mqtt_logs()->get();
        return view('devices.configuration', compact('mqtt_logs'));
    }



}