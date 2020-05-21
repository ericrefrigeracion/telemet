<?php

namespace App\Http\Controllers;

use App\Pay;
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

class DeviceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $tiny_t_devices = Device::where('admin_mon', true)->where('type_device_id', 2)->orderBy('user_id', 'asc')->get();
        $tiny_pump_devices = Device::where('admin_mon', true)->where('type_device_id', 7)->orderBy('user_id', 'asc')->get();

        return view('devices.all')->with([
                                    'tiny_t_devices' => $tiny_t_devices,
                                    'tiny_pump_devices' => $tiny_pump_devices
                                    ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function real_time(Device $device)
    {
        $data = ['device' => $device,
                   'tiny' => $device->tiny_t_device()->first(),
                   'pump' => $device->tiny_pump_device()->first(),
              'reception' => $device->receptions()->latest()->first(),
            ];

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiny_t_devices = Auth::user()->devices()->where('type_device_id', 2)->get();

        foreach ($tiny_t_devices as $device)
        {

            if($last_reception = Reception::where('device_id', $device->id)->where('data01', '!=', NULL)->latest()->first())
            {
                if($device->on_line)
                {
                    $device->last_data01 = $last_reception->data01 + $device->tiny_t_device->tcal . '°C';
                    $device->last_created_at = $last_reception->created_at->diffForHumans();
                    if($last_reception->data04)
                    {
                        $device->status = 'fas fa-arrow-circle-down';
                        $device->status_class = 'text-info';
                        $device->status_title = 'Enfriando';
                    }
                    else
                    {
                        $device->status = 'fas fa-arrow-circle-up';
                        $device->status_class = 'text-warning';
                        $device->status_title = 'Reposo';
                    }
                    if ($last_reception->rssi >= -60)
                    {
                         $device->wifi_color = 'text-success';
                         $device->wifi_description = 'Señal WiFi Buena';
                    }
                    if ($last_reception->rssi > -75 && $last_reception->rssi < -60)
                    {
                         $device->wifi_color = 'text-warning';
                         $device->wifi_description = 'Señal WiFi Aceptable';
                    }
                    if ($last_reception->rssi < -75)
                    {
                         $device->wifi_color = 'text-danger';
                         $device->wifi_description = 'Señal WiFi Mala';
                    }
                }
                else
                {
                    $device->last_data01 = '--.--';
                    $device->last_created_at = $last_reception->created_at->diffForHumans();
                    $device->wifi_color = 'text-muted';
                    $device->wifi_description = 'Sin Señal WiFi';
                }
            }
            else
            {
                $device->last_data01 = 'Sin datos';
                $device->last_created_at = 'Sin datos';
                $device->wifi_color = 'text-muted';
                $device->wifi_description = 'Sin Señal WiFi';
            }
            $device->alerts_count = Alert::where('device_id', $device->id)->where('created_at', '>', $device->view_alerts_at)->count();

        }

        $tiny_pump_devices = Auth::user()->devices()->where('type_device_id', 7)->get();

        foreach ($tiny_pump_devices as $device)
        {

            if($last_reception = Reception::where('device_id', $device->id)->where('data01', '!=', NULL)->latest()->first())
            {
                if($device->on_line)
                {
                    $device->last_data01 = $last_reception->data01 + $device->tiny_pump_device->l_cal . 'cms';
                    $device->last_created_at = $last_reception->created_at->diffForHumans();
                    if ($last_reception->rssi >= -60)
                    {
                         $device->wifi_color = 'text-success';
                         $device->wifi_description = 'Señal Celular Buena';
                    }
                    if ($last_reception->rssi > -75 && $last_reception->rssi < -60)
                    {
                         $device->wifi_color = 'text-warning';
                         $device->wifi_description = 'Señal Celular Aceptable';
                    }
                    if ($last_reception->rssi < -75)
                    {
                         $device->wifi_color = 'text-danger';
                         $device->wifi_description = 'Señal Celular Mala';
                    }
                    if($device->tiny_pump_device->channel1_status == 'disabled')
                    {
                        $device->channel1_color = 'text-muted';
                        $device->channel1_title = 'Canal Deshabilitado';
                    }
                    if($device->tiny_pump_device->channel1_status == 'success')
                    {
                        $device->channel1_color = 'text-success';
                        $device->channel1_title = 'Todo en Orden';
                    }
                    if($device->tiny_pump_device->channel1_status == 'warning')
                    {
                        $device->channel1_color = 'text-warning';
                        $device->channel1_title = 'Atencion';
                    }
                    if($device->tiny_pump_device->channel1_status == 'danger')
                    {
                        $device->channel1_color = 'text-danger';
                        $device->channel1_title = 'Falla';
                    }
                    if($device->tiny_pump_device->channel2_status == 'disabled')
                    {
                        $device->channel2_color = 'text-muted';
                        $device->channel2_title = 'Canal Deshabilitado';
                    }
                    if($device->tiny_pump_device->channel2_status == 'success')
                    {
                        $device->channel2_color = 'text-success';
                        $device->channel2_title = 'Todo en Orden';
                    }
                    if($device->tiny_pump_device->channel2_status == 'warning')
                    {
                        $device->channel2_color = 'text-warning';
                        $device->channel2_title = 'Atencion';
                    }
                    if($device->tiny_pump_device->channel2_status == 'danger')
                    {
                        $device->channel2_color = 'text-danger';
                        $device->channel2_title = 'Falla';
                    }
                    if($device->tiny_pump_device->channel3_status == 'disabled')
                    {
                        $device->channel3_color = 'text-muted';
                        $device->channel3_title = 'Canal Deshabilitado';
                    }
                    if($device->tiny_pump_device->channel3_status == 'success')
                    {
                        $device->channel3_color = 'text-success';
                        $device->channel3_title = 'Todo en Orden';
                    }
                    if($device->tiny_pump_device->channel3_status == 'warning')
                    {
                        $device->channel3_color = 'text-warning';
                        $device->channel3_title = 'Atencion';
                    }
                    if($device->tiny_pump_device->channel3_status == 'danger')
                    {
                        $device->channel3_color = 'text-danger';
                        $device->channel3_title = 'Falla';
                    }
                }
                else
                {
                    $device->last_data01 = '----';
                    $device->last_created_at = $last_reception->created_at->diffForHumans();
                    $device->wifi_color = 'text-muted';
                    $device->wifi_description = 'Sin Conexion';
                    $device->channel1_color = 'text-muted';
                    $device->channel1_title = 'Sin datos';
                    $device->channel2_color = 'text-muted';
                    $device->channel2_title = 'Sin datos';
                    $device->channel3_color = 'text-muted';
                    $device->channel3_title = 'Sin datos';
                }
            }
            else
            {
                $device->last_data01 = 'Sin datos';
                $device->last_created_at = 'Sin datos';
                $device->wifi_color = 'text-muted';
                $device->wifi_description = 'Sin Conexion';
                $device->channel1_color = 'text-muted';
                $device->channel1_title = 'Sin datos';
                $device->channel2_color = 'text-muted';
                $device->channel2_title = 'Sin datos';
                $device->channel3_color = 'text-muted';
                $device->channel3_title = 'Sin datos';
            }
            $device->alerts_count = Alert::where('device_id', $device->id)->where('created_at', '>', $device->view_alerts_at)->count();
        }

        return view('devices.index')->with([
                                        'tiny_t_devices' => $tiny_t_devices,
                                        'tiny_pump_devices' => $tiny_pump_devices
                                        ]);

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
            'id' => 'starts_with:10,20,30,40,90|required|integer|min:10000|unique:devices,id',
            'name' => 'required|max:25',
            'description' => 'max:50',
        ];

        $request->validate($rules);

        $type_device = TypeDevice::where('prefix', substr($request->id, 0, 2))->first();
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
                'l_cal' => 'required|numeric|min:-100|max:100',
                'l_min' => 'required|numeric|min:0|lt:l_max',
                'l_max' => 'required|numeric|max:480|gt:l_min',
                'l_offset' => 'required|numeric|min:0|max:480',
                'l_dly' => 'required|integer|min:0|max:360',
                'channel1_min' => 'required|numeric|min:0|lt:channel1_max',
                'channel1_max' => 'required|numeric|max:480|gt:channel1_min',
                'channel2_min' => 'required|numeric|min:0|lt:channel2_max',
                'channel2_max' => 'required|numeric|max:480|gt:channel2_min',
                'channel3_min' => 'required|numeric|min:0|lt:channel3_max',
                'channel3_max' => 'required|numeric|max:480|gt:channel3_min',
            ];
            $request->validate($rules);

            if($request->has('l_cal') && $request->l_cal != $tiny_pump_device->l_cal) alertCreate($tiny_pump_device, Auth::user()->name . " cambio la calibracion a $request->l_cal cms.", now());
            if($request->has('l_min') && $request->l_min != $tiny_pump_device->l_min) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el nivel minimo permitido a $request->l_min cms.", now());
            if($request->has('l_max') && $request->l_max != $tiny_pump_device->l_max) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el nivel maximo permitido a $request->l_max cms.", now());
            if($request->has('l_dly') && $request->l_dly != $tiny_pump_device->l_dly) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el retardo para el aviso a $request->l_dly minutos.", now());
            if($request->has('l_offset') && $request->l_offset != $tiny_pump_device->l_offset) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el offset a $request->l_offset cms.", now());
            if($request->has('channel1_min') && $request->channel1_min != $tiny_pump_device->channel1_min) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el minimo del canal 1 a $request->channel1_min cms.", now());
            if($request->has('channel1_max') && $request->channel1_max != $tiny_pump_device->channel1_max) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el maximo del canal 1 a $request->channel1_max cms.", now());
            if($request->has('channel2_min') && $request->channel2_min != $tiny_pump_device->channel2_min) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el minimo del canal 2 a $request->channel2_min cms.", now());
            if($request->has('channel2_max') && $request->channel2_max != $tiny_pump_device->channel2_max) alertCreate($tiny_pump_device, Auth::user()->name . " cambio el maximo del canal 2 a $request->channel2_max cms.", now());
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