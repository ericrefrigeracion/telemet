<?php

namespace App\Http\Controllers;

use App\Device;
use App\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $devices = Device::where('user_id', $user_id)->get();

        foreach ($devices as $device) {

            if($last_reception = Reception::where('device_id', $device->id)->latest()->first())
            {
                $device->last_data01 = $last_reception->data01;
                $device->last_created_at = $last_reception->created_at->diffForHumans();
                $device->last_rssi = $last_reception->rssi;
            }else
            {
                $device->last_data01 = 'Sin datos';
                $device->last_created_at = 'Sin datos';
                $device->last_rssi = 'Sin datos';
            }

        }

        return view('home')->with(['devices' => $devices]);
    }
}
