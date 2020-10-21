<?php

namespace App\Http\Controllers\User;

use App\Topic;
use App\Device;
use App\DisplayTopic;
use App\DataReception;
use App\ViewConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataReceptionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        if (Auth::user()->id === $device->user_id || Auth::user()->id < 3)
        {

            $view_configurations = ViewConfiguration::where('type_device_id', $device->type_device_id)->orderBy('order')->get();
            foreach ($view_configurations as $view_configuration)
            {
                $view_configuration->display_topics = DisplayTopic::where('display_id', $view_configuration->display_id)->get();
                $view_configuration->display = $view_configuration->display()->pluck('slug')->first();
                foreach ($view_configuration->display_topics as $display_topic) {
                    $display_topic->topic = Topic::find($display_topic->topic_id);
                }
            }
            //dd($view_configurations);
            return view('data-receptions.show', compact('device', 'view_configurations'));
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

}
