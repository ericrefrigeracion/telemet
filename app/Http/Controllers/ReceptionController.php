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
    public function show(Device $device)
    {

        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2) {

            $today = Carbon::today();

            if ($device->mdl == 't') $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $today)->get();
            if ($device->mdl == 'th') $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->where('created_at', '>=', $today)->get();

            if ($datas->max('created_at'))
            {

            foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

            return view('receptions.show')->with(['device' => $device, 'datas' => $datas]);

            }else{

                return view('receptions.show')->with([ 'device' => $device ]);
            }

        }else{

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

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2) {

            if ($device->mdl == 't') $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->get();
            if ($device->mdl == 'th') $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->get();

            if ($datas->max('created_at'))
            {
                foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

                $today = now();
                $sub_week = $today->subWeek();

                $device->tmax_week = $datas->where('created_at', '>=', $sub_week)->where('created_at', '<', $today)->max('data01');
                $device->tmin_week = $datas->where('created_at', '>=', $sub_week)->where('created_at', '<', $today)->min('data01');
                $device->tavg_week = $datas->where('created_at', '>=', $sub_week)->where('created_at', '<', $today)->avg('data01');
                $device->hmax_week = $datas->where('created_at', '>=', $sub_week)->where('created_at', '<', $today)->max('data02');
                $device->hmin_week = $datas->where('created_at', '>=', $sub_week)->where('created_at', '<', $today)->min('data02');
                $device->havg_week = $datas->where('created_at', '>=', $sub_week)->where('created_at', '<', $today)->avg('data02');

                return view('receptions.show-week')->with(['device' => $device, 'datas' => $datas]);

            }else{
                return view('receptions.show-week')->with([ 'device' => $device ]);
            }
        }else{
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

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2) {

            if ($device->mdl == 't') $datas = Reception::select('data01', 'created_at')->where('device_id', $device->id)->get();
            if ($device->mdl == 'th') $datas = Reception::select('data01', 'data02', 'created_at')->where('device_id', $device->id)->get();

            if ($datas->max('created_at'))
            {
                foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (3 * 60 * 60)) * 1000;

                $today = Carbon::today();
                $yesterday = Carbon::yesterday();

                $device->last_data = $datas->max('created_at')->diffForHumans();
                $device->tmax_today = $datas->where('created_at', '>=', $today)->max('data01');
                $device->tmin_today = $datas->where('created_at', '>=', $today)->min('data01');
                $device->tavg_today = $datas->where('created_at', '>=', $today)->avg('data01');
                $device->tmax_yesterday = $datas->where('created_at', '>=', $yesterday)->where('created_at', '<', $today)->max('data01');
                $device->tmin_yesterday = $datas->where('created_at', '>=', $yesterday)->where('created_at', '<', $today)->min('data01');
                $device->tavg_yesterday = $datas->where('created_at', '>=', $yesterday)->where('created_at', '<', $today)->avg('data01');

                $device->hmax_today = $datas->where('created_at', '>=', $today)->max('data02');
                $device->hmin_today = $datas->where('created_at', '>=', $today)->min('data02');
                $device->havg_today = $datas->where('created_at', '>=', $today)->avg('data02');
                $device->hmax_yesterday = $datas->where('created_at', '>=', $yesterday)->where('created_at', '<', $today)->max('data02');
                $device->hmin_yesterday = $datas->where('created_at', '>=', $yesterday)->where('created_at', '<', $today)->min('data02');
                $device->havg_yesterday = $datas->where('created_at', '>=', $yesterday)->where('created_at', '<', $today)->avg('data02');

                return view('receptions.show-all')->with(['device' => $device, 'datas' => $datas]);

            }else
            {
                return view('receptions.show-all')->with([ 'device' => $device ]);
            }


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
            'device_id' => 'starts_with:1,2|required|integer|min:1000|exists:devices,id',
            'data01' => 'required|numeric',
        ];

        $request->validate($rules);

        $reception = Reception::create($request->all());

        return $reception;

    }

}
