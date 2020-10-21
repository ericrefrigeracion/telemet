<?php

namespace App\Http\Controllers\Api;

use App\Topic;
use App\Device;
use Carbon\Carbon;
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
    public function now(Device $device, $topic)
    {

        $device->last_data = DataReception::select('value', 'created_at')->where('device_id', $device->id)->where('topic', $topic)->latest()->first();
        $device->status = $device->status;
        $device->status->icon = $device->status->icon;
        $device->protection = $device->protection;
        $device->protection->icon = $device->protection->icon;
        $device->pay_route = route('pays.create', $device->id);
        $device->alerts_route = route('alerts.show', $device->id);
        $device->data_receptions_route = route('data-receptions.show', $device->id);
        $device->configuration_route = route('devices.show', $device->id);
        $device->alerts_count = $device->alerts()->where('created_at', '>', $device->view_alerts_at)->count();

        return $device;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function data($device, $topic, $start_time, $end_time)
    {

        $start_time = Carbon::createFromTimestamp(($start_time/1000))->toDateTime();
        $end_time = Carbon::createFromTimestamp(($end_time/1000))->toDateTime();
        $datas = DataReception::select('value', 'created_at')
                                ->where('device_id', $device)
                                ->where('created_at', '>', $start_time)
                                ->where('created_at', '<', $end_time)
                                ->where('topic', $topic)
                                ->orderBy('created_at')->get();

        foreach ($datas as $data)
        {
            $data->x = $data->created_at;
            $data->y = $data->value;
        }

        return $datas;
    }

    public function all()
    {

    }


}
