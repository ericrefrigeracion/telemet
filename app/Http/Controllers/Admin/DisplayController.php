<?php

namespace App\Http\Controllers\Admin;

use App\Display;
use Illuminate\Http\Request;
use App\Http\controllers\Controller;

class DisplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $displays = Display::all();

        return view('displays.index', compact('displays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('displays.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $display
     * @return \Illuminate\Http\Response
     */
    public function show(Display $display)
    {
        return view('displays.show', compact('display'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $display
     * @return \Illuminate\Http\Response
     */
    public function edit(Display $display)
    {
        return view('displays.edit', compact('display'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'description' => 'required|string|max:40',
            'scripts' => 'string',
        ];

        $request->validate($rules);

        Display::create($request->all());

        return redirect()->route('displays.index')->with('success', ['Visualizacion creada con exito']);
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
            'name' => 'required|max:15|unique:displays,name',
            'description' => 'required|string|max:40',
            'slug' => 'required|string|max:10|unique:displays,slug',
            'scripts' => 'string',
        ];

        $request->validate($rules);

        Display::create($request->all());

        return redirect()->route('displays.index')->with('success', ['Visualizacion creada con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Display  $display
     * @return \Illuminate\Http\Response
     */
    public function destroy(Display $display)
    {
        $display->delete();
        return redirect()->route('displays.index')->with('success', ['Visualizacion eliminada con exito']);
    }
}
