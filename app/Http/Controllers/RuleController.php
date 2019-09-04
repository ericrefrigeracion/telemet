<?php

namespace App\Http\Controllers;

use App\Rule;
use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $devices = Device::all();
        foreach ($devices as $device)
        {
            $device->rules = $device->rules()->get();
        }

        return view('rules.index')->with(['devices' => $devices]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Auth::user()->devices()->get();
        foreach ($devices as $device)
        {
            $device->rules = $device->rules()->get();
        }

        return view('rules.index')->with(['devices' => $devices]);
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
            'start_time' => 'required|before:stop_time',
            'stop_time' => 'required|after:start_time',
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
        if ($rule)
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

        if ($rule)
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
        $rules = [
            'device_id' => 'required|exists:devices,id',
            'day' => 'required',
            'start_time' => 'required|before:stop_time',
            'stop_time' => 'required|after:start_time',
        ];
        $request->validate($rules);
        $rule->update($request->all());

        return redirect()->route('rules.show', $rule->id)->with('success', ['Regla actualizada con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rule $rule)
    {
        if ($rule)
        {
            $rule->delete();
            return redirect()->route('rules.index')->with('success', ['Regla eliminada con exito']);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }
}
