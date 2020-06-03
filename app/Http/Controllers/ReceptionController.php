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
    public function api_live(Request $request, Device $device)
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
    public function api_last_hour(Request $request, Device $device)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function now(Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $start_time = now()->subHour();

            $datas = Reception::where('device_id', $device->id)->where('created_at', '>=', $start_time)->get();

            if ($datas->isNotEmpty())
            {
                return view('receptions.now')->with(['device' => $device, 'datas' => $datas]);
            }
            else
            {
                return view('receptions.now')->with([ 'device' => $device ]);
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
    public function today(Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $start_time = today();

            $datas = Reception::where('device_id', $device->id)->where('created_at', '>=', $start_time)->get();

            if ($datas->isNotEmpty())
            {
                return view('receptions.today')->with(['device' => $device, 'datas' => $datas]);
            }
            else
            {
                return view('receptions.today')->with([ 'device' => $device ]);
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
    public function yesterday(Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {

            $start_time = Carbon::yesterday();
            $stop_time = Carbon::today();

            $datas = Reception::where('device_id', $device->id)->where('created_at', '>=', $start_time)->where('created_at', '<', $stop_time)->get();

            if ($datas->isNotEmpty())
            {
                return view('receptions.yesterday')->with(['device' => $device, 'datas' => $datas]);
            }
            else
            {
                return view('receptions.yesterday')->with(['device' => $device]);
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
    public function week(Device $device)
    {

        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {
            $time = now()->subWeek();

            $datas = Reception::where('device_id', $device->id)->where('created_at', '>=', $time)->get();

            if ($datas->isNotEmpty())
            {
                return view('receptions.week')->with(['device' => $device, 'datas' => $datas]);
            }
            else
            {
                return view('receptions.week')->with([ 'device' => $device ]);
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

        Reception::create($request->all());

        return 201;
    }

}
