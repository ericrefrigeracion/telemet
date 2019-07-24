<?php

namespace App\Jobs;

use App\Webhook;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RequestSub implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 30;
    public $subscription;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $subscription = $this->subscription;
        $client = new Client(['base_uri' => 'https://api.mercadopago.com/v1/subscriptions/']);
        $response = $client->request('GET', $subscription . '?access_token=' . config('app.mp_token'));




        dd($response->getBody()->getContents());
    }
}
