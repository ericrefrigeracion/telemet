<?php

namespace App\Http\Controllers;

use App\Reception;
use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceptionController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {

        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2) {

            $datas = Reception::where('device_id', $device->id)->get();

            return view('receptions.show')->with(['device' => $device, 'datas' => $datas]);

        }else{
            abort(403, 'Accion no Autorizada');
        }
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
            'device_id' => 'required|integer|exists:devices,id',
            'data01' => 'required|numeric',
        ];

        $request->validate($rules);

        $reception = Reception::create($request->all());

        return $reception;

    }


}
