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

        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2)
        {
            $time = now()->subHour();

            if ($device->mdl == 't') $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->mdl == 'th') $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();

            if ($datas->max('created_at'))
            {

            foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

            return view('receptions.show')->with(['device' => $device, 'datas' => $datas]);

            }
            else
            {
                return view('receptions.show')->with([ 'device' => $device ]);
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

        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2)
        {
            $time = now()->subDay();

            if ($device->mdl == 't') $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->mdl == 'th') $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();

            if ($datas->max('created_at'))
            {

            foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

            return view('receptions.show')->with(['device' => $device, 'datas' => $datas]);

            }
            else
            {
                return view('receptions.show')->with([ 'device' => $device ]);
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

        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2)
        {

            $time = now()->subWeek();

            if ($device->mdl == 't') $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->mdl == 'th') $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();

            if ($datas->max('created_at'))
            {
                foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

                return view('receptions.show-week')->with(['device' => $device, 'datas' => $datas]);
            }
            else
            {
                return view('receptions.show-week')->with(['device' => $device]);
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

        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2)
        {
            $time = now()->subMonth();

            if ($device->mdl == 't') $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();
            if ($device->mdl == 'th') $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $time)->get();

            if ($datas->max('created_at'))
            {

            foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

            return view('receptions.show')->with(['device' => $device, 'datas' => $datas]);

            }
            else
            {
                return view('receptions.show')->with([ 'device' => $device ]);
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

        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2)
        {
            if ($device->mdl == 't') $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->get();
            if ($device->mdl == 'th') $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->get();

            if ($datas->max('created_at'))
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
            'device_id' => 'starts_with:1,2|required|integer|min:1000|exists:devices,id',
            'data01' => 'required|numeric',
        ];

        $request->validate($rules);

        $reception = Reception::create($request->all());

        return $reception;

    }

}
