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
            $datas = Reception::where('device_id', $device->id)->where('created_at', '>=', $today)->get();

            if ($datas->max('created_at'))
            {

            foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (6 * 60 * 60)) * 1000;

            return view('receptions.show')->with(['device' => $device, 'datas' => $datas]);

            }else
            {
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
    public function show_all(Device $device)
    {

        $user_id = Auth::user()->id;
        $user_device = $device->user_id;

        if ($user_id === $user_device || $user_id === 1 || $user_id === 2) {

            $datas = Reception::where('device_id', $device->id)->get();

            if ($datas->max('created_at'))
            {
                foreach ($datas as $data) $data->created_at_unix = ($data->created_at->timestamp - (6 * 60 * 60)) * 1000;
                $today = Carbon::today();
                $yesterday = Carbon::yesterday();
                $device->last_data = $datas->max('created_at')->diffForHumans();
                $device->max_today = $datas->where('created_at', '>=', $today)->max('data01');
                $device->min_today = $datas->where('created_at', '>=', $today)->min('data01');
                $device->avg_today = $datas->where('created_at', '>=', $today)->avg('data01');
                $device->max_yesterday = $datas->where('created_at', '>=', $yesterday)->where('created_at', '<', $today)->max('data01');
                $device->min_yesterday = $datas->where('created_at', '>=', $yesterday)->where('created_at', '<', $today)->min('data01');
                $device->avg_yesterday = $datas->where('created_at', '>=', $yesterday)->where('created_at', '<', $today)->avg('data01');

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
            'device_id' => 'required|integer|exists:devices,id',
            'data01' => 'required|numeric',
        ];

        $request->validate($rules);

        $reception = Reception::create($request->all());

        return $reception;

    }

}
