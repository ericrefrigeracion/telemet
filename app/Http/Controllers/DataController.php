<?php

namespace App\Http\Controllers;

use App\Datas;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Datas  $datas
     * @return \Illuminate\Http\Response
     */
    public function show(Datas $datas)
    {
        //
    }

}
