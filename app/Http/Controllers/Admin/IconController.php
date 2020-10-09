<?php

namespace App\Http\Controllers\Admin;

use App\Icon;
use Illuminate\Http\Request;
use App\Http\controllers\Controller;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icons = Icon::paginate(10);

        return view('icons.index', compact('icons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('icons.create');
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
            'name' => 'required|string|max:15|unique:icons,name',
            'description' => 'required|string|max:30',
            'scripts' => 'string|max:40',
            'type' => 'required|string|max:15',
        ];

        $request->validate($rules);

        Icon::create($request->all());


        return redirect()->route('icons.index')->with('success', ['Icono creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function show(Icon $icon)
    {
        return view('icons.show', compact('icon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function edit(Icon $icon)
    {
        return view('icons.edit', compact('icon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Icon $icon)
    {
        $rules = [
            'name' => 'required|string|max:15',
            'description' => 'required|string|max:30',
            'scripts' => 'string|max:40',
            'type' => 'required|string|max:15',
        ];

        $request->validate($rules);

        $icon->update($request->all());


        return redirect()->route('icons.index')->with('success', ['Icono editado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Icon $icon)
    {
        $icon->delete();
        return redirect()->route('icons.index')->with('success', ['Icono eliminado con exito']);
    }
}
