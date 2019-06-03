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

            $datas = Reception::where('device_id', $device->id)->paginate(20);

            return view('receptions.show')->with(['device' => $device, 'datas' => $datas]);

        }else{
            abort(403, 'Accion no Autorizada');
        }



    }

}
