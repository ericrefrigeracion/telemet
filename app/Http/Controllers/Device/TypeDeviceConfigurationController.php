<?php

namespace App\Http\Controllers\Device;

use App\Device;
use App\TypeDevice;
use App\TopicControlType;
use Illuminate\Http\Request;
use App\TypeDeviceConfiguration;
use App\DeviceConfiguration;
use App\Http\Controllers\Controller;

class TypeDeviceConfigurationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'type_device_id' => 'required|exists:type_devices,id',
            'topic_id' => 'required|string',
            'topic_control_type_id' => 'required|exists:topic_control_types,id',
        ];

        $request->validate($rules);
        TypeDeviceConfiguration::create($request->all());

        $topic_control_type = TopicControlType::find($request->topic_control_type_id);
        $type_device = TypeDevice::find($request->type_device_id);
        $devices = Device::where('type_device_id', $type_device->id)->get();

        foreach ($devices as $device) DeviceConfiguration::create([
                                        'device_id' => $device->id,
                                        'topic_id' => $request->topic_id,
                                        'topic_control_type_id' => $topic_control_type->id,
                                        'value' => $topic_control_type->default,
                                        'status_id' => 1,
                                        'status_at' => now()
                                    ]);

        return redirect()->route('type-devices.configuration', $type_device->id)->with('success', ['Tipo de control creado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeDeviceConfiguration $type_device_configuration)
    {

        $devices = Device::where('type_device_id', $type_device_configuration->type_device_id)->get();

        foreach ($devices as $device) DeviceConfiguration::where('device_id', $device->id)
            ->where('topic_control_type_id', $type_device_configuration->topic_control_type_id)
            ->where('topic_id', $type_device_configuration->topic_id)->delete();

        $type_device_configuration->delete();

        return redirect()->route('type-devices.configuration', $type_device_configuration->type_device_id)->with('success', ['Tipo de control eliminado con exito']);
    }

}
