<?php

namespace App\Http\Controllers;

use App\Reception;
use App\Device;
use App\DeviceConfiguration;
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

        if ($user_id === $user_device) {

            $datas = Reception::where('device_id', $device->id)->get();

            return view('receptions.show')->with(['device' => $device, 'datas' => $datas]);

        }else{
            return "mmm";
        }



    }

}
