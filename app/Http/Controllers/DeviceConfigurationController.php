<?php

namespace App\Http\Controllers;

use App\DeviceConfiguration;
use Illuminate\Http\Request;

class DeviceConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeviceConfiguration  $deviceConfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceConfiguration $deviceConfiguration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeviceConfiguration  $deviceConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeviceConfiguration $deviceConfiguration)
    {
        //
    }

}
