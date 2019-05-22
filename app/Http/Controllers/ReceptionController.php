<?php

namespace App\Http\Controllers;

use App\Reception;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show(Reception $reception)
    {
        //
    }

}
