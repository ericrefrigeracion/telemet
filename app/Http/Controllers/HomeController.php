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
        return view('home.info');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $devices = Auth::user()->devices()->get();

        foreach ($devices as $device)
        {
            $device->monitor_expires = $device->monitor_expires_at->diffForHumans();
        }

        return view('home.index')->with(['devices' => $devices]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function all()
    {
        $devices = Device::where('admin_mon', '!=', null)->orderBy('monitor_expires_at', 'ASC')->get();

        foreach ($devices as $device)
        {
            $device->monitor_expires = $device->monitor_expires_at->diffForHumans();
        }

        return view('home.all')->with(['devices' => $devices]);
    }
}
