<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Device;
use App\Reception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReceptionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function live(Request $request, Device $device)
    {

        if($request->ajax())
        {
            $data = Reception::where('device_id', $device->id)->where('data01', '!=', NULL)->where('data04', '!=', NULL)->latest()->first();

            $data->x = $data->created_at->timestamp * 1000;
            $data->y = $data->data01;

            return $data;
        }
        else
        {
            return redirect()->route('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function last_hour(Request $request, Device $device)
    {

        if($request->ajax())
        {
            $start_time = now()->subHour();

            $datas = Reception::where('device_id', $device->id)->where('created_at', '>=', $start_time)->select('data01', 'created_at')->get();

            foreach ($datas as $data)
            {
                $data->x = $data->created_at->timestamp * 1000;
                $data->y = $data->data01;
            }

            return $datas;
        }
        else
        {
            return redirect()->route('home');
        }
    }
}
