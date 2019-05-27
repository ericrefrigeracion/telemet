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
    public function show($id)
    {
        $device_id = $id;
        $user_id = Auth::user()->id;
        $info = Device::findOrFail($device_id);

        $user_device = $info->user_id;

        if ($user_id === $user_device) {

            $datas = Reception::where('device_id', $device_id)->get();
            $config = DeviceConfiguration::where('device_id', $device_id)->first();

            return view('receptions.show')->with(['info' => $info,'datas' => $datas, 'config' => $config]);

        }else{
            return "mmm";
        }



    }

}
