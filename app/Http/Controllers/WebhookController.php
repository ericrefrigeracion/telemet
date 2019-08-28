<?php

namespace App\Http\Controllers;

use App\Webhook;
use GuzzleHttp\Client;

use App\Jobs\RequestPay;
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
    public function store(Request $request)
    {

        Webhook::create($request->all());

        //if ($webhook->type == 'payment') RequestPay::dispatch($webhook->data_id);
        //if ($webhook->type == 'subscription') RequestSub::dispatch($webhook->data_id);

        return response('Ok', 201);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ipn(Request $request)
    {

        $webhook = new Webhook;
        $webhook->webhook_id = $request->id;
        $webhook->topic = $request->topic;
        $webhook->save();


        //Webhook::create($request->all());

        //if ($webhook->type == 'payment') RequestPay::dispatch($webhook->data_id);
        //if ($webhook->type == 'subscription') RequestSub::dispatch($webhook->data_id);

        return 201;
    }

}
