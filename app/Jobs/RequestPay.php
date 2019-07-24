<?php

namespace App\Jobs;

use App\Webhook;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RequestPay implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 30;
    public $pay_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pay_id)
    {
        $this->pay_id = $pay_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $pay_id = $this->pay_id;
        $client = new Client(['base_uri' => 'https://api.mercadopago.com/v1/payments/']);
        $response = $client->request('GET', $pay_id . '?access_token=' . config('app.mp_token'));

        dd($response->getBody()->getContents());

        $webhook = Webhook::find('data_id', $pay_id);
        $webhook->ip_address = $request->input('aditional_info.ip_address');
        $webhook->authorization_code = $request->input('authorization_code');
        $webhook->payer_dni = $request->input('card.cardholder.identification.number');
        $webhook->payer_dni = $request->input('card.cardholder.identification.number');
        $webhook->payer_name = $request->input('card.cardholder.name');
        $webhook->payer_name = $request->input('card.cardholder.name');



        $webhook->update();



    }
}
