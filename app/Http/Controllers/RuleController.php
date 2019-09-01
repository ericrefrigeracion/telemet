<?php

namespace App\Http\Controllers;

use App\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rules = Auth::user()->devices()->rules()->paginate(20);

        return view('pays.index')->with(['pays' => $pays]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'device_id' => 'required|exists:devices,id',
            'day' => 'required',
            'start_time' => 'required|lt:stop_time',
            'stop_time' => 'required|gt:start_time',
        ];

        $request->validate($rules);
        Rule::create($request->all());

        return redirect()->route('rules.index')->with('success', ['Regla creada con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function show(Rule $rule)
    {
        if (Auth::user()->id === $rule->device()->user_id || Auth::user()->id === 1 || Auth::user()->id === 2)
        {
            return view('rules.show')->with(['rule' => $rule]);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function edit(Rule $rule)
    {

        if (Auth::user()->id === $rule->device()->user_id || Auth::user()->id === 1 || Auth::user()->id === 2)
        {
            return view('rules.edit', compact('rule'));
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
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rule $rule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rule $rule)
    {
        if (Auth::user()->id === $device->user_id || Auth::user()->id === 1 || Auth::user()->id === 2) {

            $device->delete();
            return redirect()->route('devices.index')->with('success', ['Dispositivo eliminado con exito']);

        }else{
            abort(403, 'Accion no Autorizada');
        }
    }
}
