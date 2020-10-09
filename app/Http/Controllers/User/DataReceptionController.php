<?php

namespace App\Http\Controllers\User;

use App\Topic;
use App\Device;
use App\DataReception;
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
            return view('data-receptions.show', compact('device'));
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

}
