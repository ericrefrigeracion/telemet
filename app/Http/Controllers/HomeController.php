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
    public function info()
    {
        return view('info');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $devices = Auth::user()->devices()->orderBy('monitor_expires_at', 'DESC')->get();

        foreach ($devices as $device)
        {
            $device->monitor_expires = $device->monitor_expires_at->diffForHumans();
        }

        return view('home')->with(['devices' => $devices]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function all()
    {
        $devices = Device::all();

        foreach ($devices as $device)
        {
            $device->monitor_expires = $device->monitor_expires_at->diffForHumans();
        }

        return view('home')->with(['devices' => $devices]);
    }
}
