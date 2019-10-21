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
        $user = Auth::user();
        $device = Device::findOrFail($request->device_id);

        if ($user->id === $device->user_id || Auth::user()->id < 3)
        {
            $rules = [
                'day' => 'required',
                'start_time' => 'required|before:stop_time',
                'stop_time' => 'required|after:start_time',
            ];
            $request->validate($rules);
            Rule::create($request->all());

            alertCreate($device, "Se creo una regla para $request->day.", now());

            if($user->id < 3) return redirect()->route('rules.all')->with('success', ['Regla creada con exito']);
            return redirect()->route('rules.index')->with('success', ['Regla creada con exito']);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function show(Rule $rule)
    {
        $user = Auth::user();
        $user_device = Device::findOrFail($rule->device_id)->user_id;

        if ($user->id === $user_device || Auth::user()->id < 3)
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

        $user = Auth::user();
        $device = Device::findOrFail($rule->device_id);

        if ($user->id === $device->user_id || Auth::user()->id < 3)
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
        $user = Auth::user();
        $device = Device::findOrFail($rule->device_id);

        if ($user->id === $device->user_id || Auth::user()->id < 3)
        {
            $rules = [
                'day' => 'required',
                'start_time' => 'required|before:stop_time',
                'stop_time' => 'required|after:start_time',
            ];
            $request->validate($rules);

            if($request->has('day') && $request->day != $rule->day) alertCreate($device, "Cambio dia de horario permitido a $request->day.", now());
            if($request->has('start_time') && $request->start_time != $rule->start_time) alertCreate($device, "Cambio hora de inicio de horario permitido a $request->start_time.", now());
            if($request->has('stop_time') && $request->stop_time != $rule->stop_time) alertCreate($device, "Cambio hora de finalizacion de horario permitido a $request->stop_time.", now());

            $rule->update($request->all());

            if($user->id < 3) return redirect()->route('rules.all')->with('success', ['Regla actualizada con exito']);
            return redirect()->route('rules.show', $rule->id)->with('success', ['Regla actualizada con exito']);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rule $rule)
    {
        $user = Auth::user();
        $user_device = Device::findOrFail($rule->device_id)->user_id;

        if ($user->id === $user_device || Auth::user()->id < 3)
        {
            $rule->delete();
            alertCreate($device, "Se elimino una regla para $rule->day.", now());
            return redirect()->route('rules.index')->with('success', ['Regla eliminada con exito']);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }
}
