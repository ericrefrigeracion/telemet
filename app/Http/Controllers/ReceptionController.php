<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
    public function show_hour(Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $time = now()->subHour();

            if ($device->type_device_id == 1) $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->where('data01', '!=', null)->get();
            if ($device->type_device_id == 2) $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->type_device_id == 3) $datas = Reception::select('data01', 'data02','data03', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();

            if (isset($datas))
            {

            foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

            return view('receptions.show-last-hour')->with(['device' => $device, 'datas' => $datas]);

            }
            else
            {
                return view('receptions.show-last-hour')->with([ 'device' => $device ]);
            }

        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show_day(Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $time = now()->subDay();

            if ($device->type_device_id == 1) $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->type_device_id == 2) $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->type_device_id == 3) $datas = Reception::select('data01', 'data02','data03', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();

            if (isset($datas))
            {

            foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

            return view('receptions.show-last-day')->with(['device' => $device, 'datas' => $datas]);

            }
            else
            {
                return view('receptions.show-last-day')->with([ 'device' => $device ]);
            }

        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show_week(Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {

            $time = now()->subWeek();

            if ($device->type_device_id == 1) $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->type_device_id == 2) $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->type_device_id == 3) $datas = Reception::select('data01', 'data02','data03', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();

            if (isset($datas))
            {
                foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

                return view('receptions.show-last-week')->with(['device' => $device, 'datas' => $datas]);
            }
            else
            {
                return view('receptions.show-last-week')->with(['device' => $device]);
            }
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show_month(Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $time = now()->subMonth();

            if ($device->type_device_id == 1) $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->type_device_id == 2) $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->type_device_id == 3) $datas = Reception::select('data01', 'data02','data03', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();

            if (isset($datas))
            {
            foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

            return view('receptions.show-last-month')->with(['device' => $device, 'datas' => $datas]);

            }
            else
            {
                return view('receptions.show-last-month')->with([ 'device' => $device ]);
            }

        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show_all(Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            if ($device->type_device_id == 1) $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->get();
            if ($device->type_device_id == 2) $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->get();
            if ($device->type_device_id == 3) $datas = Reception::select('data01', 'data02', 'data03', 'created_at')->where('device_id', $device->id)->get();

            if (isset($datas))
            {
                foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

                return view('receptions.show-all')->with(['device' => $device, 'datas' => $datas]);
            }
            else
            {
                return view('receptions.show-all')->with([ 'device' => $device ]);
            }
        }
        else
        {
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
            'device_id' => 'exists:devices,id',
            'data01' => 'required|numeric',
        ];

        $request->validate($rules);

        $reception = Reception::create($request->all());
        return 200;
    }

}
