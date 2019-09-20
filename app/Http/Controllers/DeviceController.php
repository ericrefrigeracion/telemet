<?php

namespace App\Http\Controllers;

use App\Pay;
use App\Alert;
use App\Price;
use App\Device;
use App\TypeRule;
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
        $devices = Device::where('admin_mon', true)->orderBy('user_id', 'asc')->get();

        return view('devices.all')->with(['devices' => $devices]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Auth::user()->devices()->get();

        foreach ($devices as $device) {

            $device->type_rule_description = TypeRule::find($device->type_rule_id)->description;
            if($last_reception = Reception::where('device_id', $device->id)->latest()->first())
            {
                if($device->on_line)
                {
                    $device->last_data01 = $last_reception->data01 . '°C';
                    $device->last_created_at = $last_reception->created_at->diffForHumans();
                    $device->last_rssi = $last_reception->rssi;
                }
                else
                {
                    $device->last_data01 = '--.--';
                    $device->last_created_at = $last_reception->created_at->diffForHumans();
                }
            }
            else
            {
                $device->last_data01 = 'Sin datos';
                $device->last_created_at = 'Sin datos';
            }
            $device->alerts_count = Alert::where('device_id', $device->id)->where('created_at', '>', $device->view_alerts_at)->count();

        }

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
            'id' => 'starts_with:10,20,90|required|integer|min:10000|unique:devices,id',
            'name' => 'required|max:25',
            'description' => 'max:50',
        ];

        $request->validate($rules);

        $type_device = TypeDevice::where('prefix', substr($request->id, 0, 2))->first();
        $device = new Device;

        $device->id = $request->id;
        $device->user_id = Auth::user()->id;
        $device->type_device_id = $type_device->id;
        $device->type_rule_id = 1;
        $device->name = $request->name;
        $device->description = $request->description;
        $device->view_alerts_at = now();
        $device->monitor_expires_at = now()->addWeek();
        $device->send_mails = true;
        $device->admin_mon = true;
        $device->protected = true;
        $device->on_line = false;
        $device->on_temp = false;
        $device->on_hum = false;
        $device->on_t_set_point = false;
        $device->on_h_set_point = false;
        $device->tmon = true;
        $device->tmin = 0;
        $device->tmax = 0;
        $device->tdly = 30;
        $device->tcal = 0;
        $device->hmon = false;
        $device->hmin = 50;
        $device->hmax = 50;
        $device->hdly = 30;
        $device->hcal = 0;
        $device->t_set_point = 0;
        $device->t_is = 'higher';
        $device->t_change_at = now();
        $device->h_set_point = 50;
        $device->h_is = 'higher';
        $device->h_change_at = now();

        $device->save();

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
            $type_rule = TypeRule::find($device->type_rule_id);
            return view('devices.show')->with(['device' => $device, 'rule' => $type_rule]);
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
    public function log($id)
    {
        $device = Device::findOrFail($id);
        $device_logs = Reception::where('device_id', $id)->where('log', '!=', 200)->latest()->paginate(20);

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
            return view('devices.edit', compact('device'));
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

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $rules = [
                'name' => 'required|max:25',
                'description' => 'max:50',
                'type_rule_id' => 'required|exists:type_rules,id',
                'send_mails' => 'boolean',
                't_set_point' => 'filled|numeric|min:-30|max:80',
                'tcal' => 'filled|numeric|min:-5|max:5',
                'tmon' => 'boolean',
                't_set_point' => 'filled|numeric|min:-30|max:80',
                'tmin' => 'filled|numeric|min:-30|max:80',
                'tmax' => 'filled|numeric|min:-30|max:80',
                'tdly' => 'filled|integer|min:0|max:60',
                'hmon' => 'boolean',
                'h_set_point' => 'filled|numeric|min:-30|max:80',
                'hcal' => 'filled|numeric|min:-5|max:5',
                'h_set_point' => 'filled|numeric|min:-30|max:80',
                'hmin' => 'filled|numeric|min:0|max:95',
                'hmax' => 'filled|numeric|min:0|max:95',
                'hdly' => 'filled|integer|min:0|max:60',
            ];

            $request->validate($rules);

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