<?php

namespace App\Http\Controllers\Api;

use App\Topic;
use App\Device;
use App\DataReception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function now($device, $topic)
    {

        $datas = DataReception::select('value', 'created_at')->where('device_id', $device)->where('topic', $topic)->latest()->first();

        return $datas;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function data($device, $topic, $month, $day)
    {
        $datas = DataReception::select('value', 'created_at')
                                ->where('device_id', $device)
                                ->whereMonth('created_at', $month)
                                ->whereDay('created_at', $day)
                                ->where('topic', $topic)
                                ->orderBy('created_at')->get();

        return $datas;
    }


}
