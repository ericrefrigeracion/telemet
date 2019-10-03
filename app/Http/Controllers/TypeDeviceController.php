<?php

namespace App\Http\Controllers;

use App\TypeDevice;
use Illuminate\Http\Request;

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
        return view('type-devices.create');
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
            'description' => 'required|string|max:40',
            'data01_unit' => 'nullable|string|max:5',
            'data01_name' => 'nullable|string|max:25',
            'data02_unit' => 'nullable|string|max:5',
            'data02_name' => 'nullable|string|max:25',
            'data03_unit' => 'nullable|string|max:5',
            'data03_name' => 'nullable|string|max:25',
            'data04_unit' => 'nullable|string|max:5',
            'data04_name' => 'nullable|string|max:25',
            'data05_unit' => 'nullable|string|max:5',
            'data05_name' => 'nullable|string|max:25',
            'data06_unit' => 'nullable|string|max:5',
            'data06_name' => 'nullable|string|max:25',
            'data07_unit' => 'nullable|string|max:5',
            'data07_name' => 'nullable|string|max:25',
            'data08_unit' => 'nullable|string|max:5',
            'data08_name' => 'nullable|string|max:25',
            'data09_unit' => 'nullable|string|max:5',
            'data09_name' => 'nullable|string|max:25',
            'data10_unit' => 'nullable|string|max:5',
            'data10_name' => 'nullable|string|max:25',
            'data11_unit' => 'nullable|string|max:5',
            'data11_name' => 'nullable|string|max:25',
            'data12_unit' => 'nullable|string|max:5',
            'data12_name' => 'nullable|string|max:25',
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
        return view('type-devices.edit')->with(['type_device' => $type_device]);
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
            'description' => 'required|string|max:40',
            'data01_unit' => 'nullable|string|max:5',
            'data01_name' => 'nullable|string|max:25',
            'data02_unit' => 'nullable|string|max:5',
            'data02_name' => 'nullable|string|max:25',
            'data03_unit' => 'nullable|string|max:5',
            'data03_name' => 'nullable|string|max:25',
            'data04_unit' => 'nullable|string|max:5',
            'data04_name' => 'nullable|string|max:25',
            'data05_unit' => 'nullable|string|max:5',
            'data05_name' => 'nullable|string|max:25',
            'data06_unit' => 'nullable|string|max:5',
            'data06_name' => 'nullable|string|max:25',
            'data07_unit' => 'nullable|string|max:5',
            'data07_name' => 'nullable|string|max:25',
            'data08_unit' => 'nullable|string|max:5',
            'data08_name' => 'nullable|string|max:25',
            'data09_unit' => 'nullable|string|max:5',
            'data09_name' => 'nullable|string|max:25',
            'data10_unit' => 'nullable|string|max:5',
            'data10_name' => 'nullable|string|max:25',
            'data11_unit' => 'nullable|string|max:5',
            'data11_name' => 'nullable|string|max:25',
            'data12_unit' => 'nullable|string|max:5',
            'data12_name' => 'nullable|string|max:25',
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
}
