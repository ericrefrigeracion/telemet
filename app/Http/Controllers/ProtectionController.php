<?php

namespace App\Http\Controllers;

use App\Protection;
use Illuminate\Http\Request;

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
        return view('protections.create');
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
            'type' => 'required|string|unique:protections,type',
            'description' => 'required|string',
            'class' => 'required|string',
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
        return view('protections.edit')->with(['protection' => $protection]);
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
            'description' => 'required|string',
            'class' => 'required|string',
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
