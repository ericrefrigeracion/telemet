<?php

namespace App\Http\Controllers\Device;

use App\Topic;
use App\Icon;
use App\TypeDevice;
use App\TopicControlType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_devices = TypeDevice::all();
        return view('type-devices.index')->with(['type_devices' => $type_devices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icons = Icon::where('type', 'type-device')->pluck('name', 'id')->all();
        return view('type-devices.create', compact('icons'));
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
            'prefix' => 'required|integer|min:10|max:99|unique:type_devices,prefix',
            'model' => 'required|string|max:20|unique:type_devices,model',
            'description' => 'required|string|max:50',
            'icon_id' => 'required|exists:icons,id'
        ];

        $request->validate($rules);
        TypeDevice::create($request->all());

        return redirect()->route('type-devices.index')->with('success', ['Tipo de Dispositivo creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeDevice  $type_device
     * @return \Illuminate\Http\Response
     */
    public function show(TypeDevice $type_device)
    {
        return view('type-devices.show')->with(['type_device' => $type_device]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeDevice  $type_device
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeDevice $type_device)
    {
        $icons = Icon::where('type', 'type-device')->pluck('name', 'id')->all();
        return view('type-devices.edit', compact('type_device', 'icons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeDevice  $type_device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeDevice $type_device)
    {
        $rules = [
            'prefix' => 'required|integer|min:10|max:99',
            'model' => 'required|string|max:20',
            'description' => 'required|string|max:50',
            'icon_id' => 'required|exists:icons,id'
        ];

        $request->validate($rules);
        $type_device->update($request->all());

        return redirect()->route('type-devices.show', $type_device->id)->with('success', ['Tipo de Dispositivo actualizado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeDevice  $type_device
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeDevice $type_device)
    {
        $type_device->delete();
        return redirect()->route('type-devices.index')->with('success', ['Tipo de Dispositivo eliminado con exito']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeDeviceConfiguration  $typeDeviceConfiguration
     * @return \Illuminate\Http\Response
     */
    public function configuration(TypeDevice $type_device)
    {
        $topic_control_types = TopicControlType::pluck('name', 'id')->all();
        $topics = Topic::pluck('slug', 'id')->all();
        return view('type-devices.configuration', compact('type_device', 'topic_control_types', 'topics'));
    }
}
