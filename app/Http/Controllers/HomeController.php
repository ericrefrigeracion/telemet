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

            if($last_reception = Reception::where('device_id', $device->id)->orderBy('created_at', 'desc')->first())
            {
                $device = array_add($device,  'last_connection', $last_reception->created_at);
                $device = array_add($device,  'rssi', $last_reception->rssi);
            }


        }

        return view('home')->with(['devices' => $devices]);
    }
}
