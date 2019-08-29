<?php

namespace App\Http\Controllers;

use App\Alert;
use App\User;
use App\Price;
use App\Device;
use App\Webhook;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $webhooks = Webhook::paginate(20);

        return view('webhooks.index')->with(['webhooks' => $webhooks]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Webhook  $webhook
     * @return \Illuminate\Http\Response
     */
    public function show(Webhook $webhook)
    {
         return view('webhooks.show')->with(['webhook' => $webhook]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ipn(Request $request)
    {
        Webhook::create([
            'webhook_id' => $request->id,
            'topic' => $request->topic
        ]);

        return 201;
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pay(User $user, Device $device, Price $price)
    {


        Alert::create([
            'device_id' => $device->id,
            'log' => $price->id,
            'alert_created_at' => now(),
        ]);


        return 201;
    }

}
