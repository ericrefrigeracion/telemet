<?php

namespace App\Http\Controllers\Admin;

use App\Icon;
use App\Protection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProtectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $protections = Protection::all();
        return view('protections.index')->with(['protections' => $protections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icons = Icon::where('type', 'protection')->pluck('name', 'id')->all();
        return view('protections.create', compact('icons'));
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
            'icon_id' => 'required|exists:icons,id',
            'type' => 'required|string|unique:protections,type',
            'description' => 'required|string',
        ];

        $request->validate($rules);
        Protection::create($request->all());

        return redirect()->route('protections.index')->with('success', ['Tipo de Proteccion creada con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Protection  $protection
     * @return \Illuminate\Http\Response
     */
    public function show(Protection $protection)
    {
        return view('protections.show')->with(['protection' => $protection]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Protection  $protection
     * @return \Illuminate\Http\Response
     */
    public function edit(Protection $protection)
    {
        $icons = Icon::where('type', 'protection')->pluck('name', 'id')->all();
        return view('protections.edit', compact('icons', 'protection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Protection  $protection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Protection $protection)
    {
        $rules = [
            'icon_id' => 'required|exists:icons,id',
            'type' => 'required|string|max:10',
            'description' => 'required|string|max:30',
        ];

        $request->validate($rules);
        $protection->update($request->all());

        return redirect()->route('protections.show', $protection->id)->with('success', ['Tipo de proteccion actualizada con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Protection  $protection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Protection $protection)
    {
        $protection->delete();
        return redirect()->route('protections.index')->with('success', ['Tipo de Proteccion eliminada con exito']);
    }
}
