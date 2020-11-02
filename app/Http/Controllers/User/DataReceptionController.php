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
        if ($device->users->where('id', Auth::user()->id) || Auth::user()->hasRole('super.admin'))
        {

            $configurations = ViewConfiguration::where('type_device_id', $device->type_device_id)->orderBy('order')->get();
            foreach ($configurations as $configuration)
            {
                $configuration->display_topics = DisplayTopic::where('display_id', $configuration->display_id)->get();
                $configuration->display = $configuration->display()->pluck('slug')->first();
                $configuration->title = $configuration->display()->pluck('title')->first();
                foreach ($configuration->display_topics as $display_topic) {
                    $display_topic->topic = Topic::find($display_topic->topic_id);
                }
            }
            //dd($view_configurations);
            return view('data-receptions.show', compact('device', 'configurations'));
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

}
