<?php

namespace App\Http\Controllers;

use App\Pay;
use App\User;
use App\Alert;
use App\Price;
use App\Device;
use App\TinyTDevice;
use App\TinyPumpDevice;
use App\NoFrostDevice;
use App\Protection;
use App\TypeDevice;
use App\Reception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateDeviceRequest;

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
        return view('devices.index')->with(['user_id' => Auth::user()->id]);
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
            'user_id' => $user->id,
            'type_device_id' => $type_device->id,
            'protection_id' => 1,
            'name' => $request->name,
            'description' => $request->description,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'notification_email' => $user->email,
            'notification_phone_number' => $user->phone_area_code . ' - ' . $user->phone_number,
            'monitor_expires_at' => now()->addDays(70),
            'view_alerts_at' => now(),
        ]);

        if($type_device->id == 2)
        {
            TinyTDevice::create([
                'id' => $request->id,
                'device_id' => $request->id,
                'on_temp' => false,
                'on_t_set_point' => false,
                'tmin' => 0,
                'tmax' => 10,
                'tdly' => 30,
                'tcal' => 0,
                't_set_point' => 5,
                't_is' => 'higher',
                't_change_at' => now(),
                'on_performance' => false,
                'pdly' => 30,
                'pmin' => 0,
                'pmax' => 30,
            ]);
        }

        if($type_device->id == 7)
        {
            TinyPumpDevice::create([
                'id' => $request->id,
                'device_id' => $request->id,
                'on_level' => false,
                'signal_mode' => 'local',
                'control_mode' => 'emptied',
                'l_cal' => 0,
                'l_offset' => 0,
                'l_min' => 0,
                'l_max' => 480,
                'l_dly' => 0,
                'channel1_status' => 'disabled',
                'channel1_config' => 'disabled',
                'channel1_min' => 0,
                'channel1_max' => 1,
                'channel2_status' => 'disabled',
                'channel2_config' => 'disabled',
                'channel2_min' => 0,
                'channel2_max' => 1,
                'channel3_status' => 'disabled',
                'channel3_config' => 'disabled',
                'channel3_min' => 0,
                'channel3_max' => 1,
            ]);
        }

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

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {

            return view('devices.show')->with(['device' => $device]);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function log(Device $device)
    {
        $device_logs = $device->receptions()->where('log', '!=', 200)->latest()->paginate(20);

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
        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $protections = Protection::all();
            return view('devices.edit')->with(['device' => $device, 'protections' => $protections]);
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
    public function update_device(Request $request, Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $rules = [
                'protection_id' => 'required|exists:protections,id',
                'name' => 'required|max:25',
                'description' => 'max:50',
                'notification_email' => 'required|string',
                'notification_phone_number' => 'required',
            ];

            $request->validate($rules);

            if($device->protection_id != 1 && $request->protection_id == 1)
            {
                $request['protected'] = true;
                $device->tiny_t_device->update([
                    'on_temp' => true,
                    't_out_at' => null,
                ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function update_tiny_t(Request $request, TinyTDevice $tiny_t_device)
    {
        if (Auth::user()->id === $tiny_t_device->device->user_id || Auth::user()->id < 3)
        {

            $rules = [
                'tcal' => 'required|numeric|min:-5|max:5',
                'tmin' => 'required|numeric|min:-40|lt:tmax',
                'tmax' => 'required|numeric|max:80|gt:tmin',
                'tdly' => 'required|integer|min:0|max:360',
                'pmin' => 'filled|numeric|min:0|lt:pmax',
                'pmax' => 'filled|numeric|max:50|gt:pmin',
            ];
            $request->validate($rules);

            if($request->has('tcal') && $request->tcal != $tiny_t_device->tcal) alertCreate($tiny_t_device, Auth::user()->name . " cambio la calibracion a $request->tcal °C.", now());
            if($request->has('tmin') && $request->tmin != $tiny_t_device->tmin) alertCreate($tiny_t_device, Auth::user()->name . " cambio la temperatura minima a $request->tmin °C.", now());
            if($request->has('tmax') && $request->tmax != $tiny_t_device->tmax) alertCreate($tiny_t_device, Auth::user()->name . " cambio la temperatura maxima a $request->tmax °C.", now());
            if($request->has('tdly') && $request->tdly != $tiny_t_device->tdly) alertCreate($tiny_t_device, Auth::user()->name . " cambio el retardo para el aviso a $request->tdly minutos.", now());
            if($request->has('pmin') && $request->pmin != $tiny_t_device->pmin) alertCreate($tiny_t_device, Auth::user()->name . " cambio la minima performance a $request->pmin °C/h.", now());
            if($request->has('pmax') && $request->pmax != $tiny_t_device->pmax) alertCreate($tiny_t_device, Auth::user()->name . " cambio maxima performance a $request->pmax °C/h.", now());

            $tiny_t_device->update($request->all());

            return redirect()->route('devices.show', $tiny_t_device->device->id)->with('success', ['Dispositivo actualizado con exito']);

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
    public function update_tiny_pump(Request $request, TinyPumpDevice $tiny_pump_device)
    {
        if (Auth::user()->id === $tiny_pump_device->device->user_id || Auth::user()->id < 3)
        {
            $rules = [
                'signal_mode' => 'required|string|in:local,remote',
                'signal_number' => 'nullable|exists:devices,id',
                'control_mode' => 'required|string|in:filled,emptied',
                'l_cal' => 'required|numeric|min:-100|max:100',
                'l_offset' => 'required|numeric|min:0|max:480',
                'l_min' => 'required|numeric|min:0|lt:l_max',
                'l_max' => 'required|numeric|max:480|gt:l_min',
                'l_dly' => 'required|integer|min:0|max:360',
                'channel1_config' => 'required|string',
                'channel1_min' => 'required|numeric|min:0|lt:channel1_max',
                'channel1_max' => 'required|numeric|max:480|gt:channel1_min',
                'channel2_config' => 'required|string',
                'channel2_min' => 'required|numeric|min:0|lt:channel2_max',
                'channel2_max' => 'required|numeric|max:480|gt:channel2_min',
                'channel3_config' => 'required|string',
                'channel3_min' => 'required|numeric|min:0|lt:channel3_max',
                'channel3_max' => 'required|numeric|max:480|gt:channel3_min',
            ];
            $request->validate($rules);

            if($request->has('signal_mode') && $request->signal_mode != $tiny_pump_device->signal_mode) alertCreate($tiny_pump_device, Auth::user()->name . " combio la configuracion de la Señal de Control.", now());
            if($request->has('signal_number') && $request->signal_number != $tiny_pump_device->signal_number) alertCreate($tiny_pump_device, Auth::user()->name . " el dispositivo de Señal de Control a $request->signal_number .", now());
            if($request->has('control_mode') && $request->control_mode != $tiny_pump_device->control_mode) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el Tipo de control de las bombas.", now());
            if($request->has('l_cal') && $request->l_cal != $tiny_pump_device->l_cal) alertCreate($tiny_pump_device, Auth::user()->name . " cambio la calibracion a $request->l_cal cms.", now());
            if($request->has('l_min') && $request->l_min != $tiny_pump_device->l_min) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el nivel minimo permitido a $request->l_min cms.", now());
            if($request->has('l_max') && $request->l_max != $tiny_pump_device->l_max) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el nivel maximo permitido a $request->l_max cms.", now());
            if($request->has('l_dly') && $request->l_dly != $tiny_pump_device->l_dly) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el retardo para el aviso a $request->l_dly minutos.", now());
            if($request->has('l_offset') && $request->l_offset != $tiny_pump_device->l_offset) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el offset a $request->l_offset cms.", now());
            if($request->has('channel1_config') && $request->channel1_config != $tiny_pump_device->channel1_config) alertCreate($tiny_pump_device, Auth::user()->name . " cambio la configuracion del Canal 1", now());
            if($request->has('channel1_min') && $request->channel1_min != $tiny_pump_device->channel1_min) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el minimo del canal 1 a $request->channel1_min cms.", now());
            if($request->has('channel1_max') && $request->channel1_max != $tiny_pump_device->channel1_max) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el maximo del canal 1 a $request->channel1_max cms.", now());
            if($request->has('channel2_config') && $request->channel2_config != $tiny_pump_device->channel2_config) alertCreate($tiny_pump_device, Auth::user()->name . " cambio la configuracion del Canal 2", now());
            if($request->has('channel2_min') && $request->channel2_min != $tiny_pump_device->channel2_min) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el minimo del canal 2 a $request->channel2_min cms.", now());
            if($request->has('channel2_max') && $request->channel2_max != $tiny_pump_device->channel2_max) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el maximo del canal 2 a $request->channel2_max cms.", now());
            if($request->has('channel3_config') && $request->channel3_config != $tiny_pump_device->channel3_config) alertCreate($tiny_pump_device, Auth::user()->name . " cambio la configuracion del Canal 3", now());
            if($request->has('channel3_min') && $request->channel3_min != $tiny_pump_device->channel3_min) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el minimo del canal 3 a $request->channel3_min cms.", now());
            if($request->has('channel3_max') && $request->channel3_max != $tiny_pump_device->channel3_max) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el maximo del canal 3 a $request->channel3_max cms.", now());

            $tiny_pump_device->device_update = null;
            $tiny_pump_device->update($request->all());

            return redirect()->route('devices.show', $tiny_pump_device->device->id)->with('success', ['Dispositivo actualizado con exito']);

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

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $device->delete();
            return redirect()->route('devices.index')->with('success', ['Dispositivo eliminado con exito']);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

}