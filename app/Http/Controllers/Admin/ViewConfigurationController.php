<?php

namespace App\Http\Controllers\Admin;

use App\TypeDevice;
use App\Display;
use App\Topic;
use App\ViewConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view_configurations = ViewConfiguration::paginate(20);

        return view('view-configurations.index', compact('view_configurations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_devices = TYpeDevice::pluck('model', 'id')->all();
        $displays = Display::pluck('name', 'id')->all();

        return view('view-configurations.create', compact('type_devices', 'displays', 'topics'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $display
     * @return \Illuminate\Http\Response
     */
    public function show(ViewConfiguration $view_configuration)
    {
        return view('view-configurations.show', compact('view_configuration'));
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
            'type_device_id' => 'required|integer|min:2|exists:type_devices,id',
            'display_id' => 'required|integer|min:1|exists:displays,id',
            'order' => 'required|integer|min:1|max:20'
        ];

        $request->validate($rules);

        ViewConfiguration::create($request->all());


        return redirect()->route('view-configurations.index')->with('success', ['Configuracion de vista creada con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ViewConfiguration  $viewConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(ViewConfiguration $view_configuration)
    {
        $view_configuration->delete();
        return redirect()->route('view-configurations.index')->with('success', ['Configuracion de vista eliminada con exito']);
    }
}
