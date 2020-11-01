<?php

namespace App\Http\Controllers\Admin;

use App\Pay;
use App\User;
use App\Price;
use App\Device;
use App\Webhook;
use Illuminate\Http\Request;
use App\Jobs\Pay\PaymentRevissionJob;
use App\Http\Controllers\Controller;

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
    public function pay(Request $request, $user_id, $device_id, $price_id)
    {

        $payment_id = $request->data_id;

        PaymentRevissionJob::dispatch($payment_id, $user_id, $device_id, $price_id);

        return 201;
    }

}
