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

        $webhook = new Webhook;
        $webhook->id = $request->input('id');
        $webhook->type = $request->input('type');
        $webhook->user_id = $request->input('user_id');
        $webhook->application_id = $request->input('application_id');
        $webhook->version = $request->input('version');
        $webhook->action = $request->input('action');
        $webhook->data_id = $request->input('data.id');
        $webhook->date_created = $request->input('date_created');
        $webhook->save();

        if ($webhook->type == 'payment') RequestPay::dispatch($webhook->data_id);
        if ($webhook->type == 'subscription') RequestSub::dispatch($webhook->data_id);

        return response('Objeto creado', 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Webhook  $webhook
     * @return \Illuminate\Http\Response
     */
    public function prueba()
    {
        $preference = 'sdfa';

        return view('webhooks.prueba')->with(['preference' => $preference]);


    }
}
