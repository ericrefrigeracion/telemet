<?php

namespace App\Jobs;

use App\Pay;
use App\Device;
use App\MailAlert;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PaymentRevissionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $webhook_id;
    public $tries = 5;
    public $timeout = 30;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($webhook_id)
    {
         $this->webhook_id = $webhook_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $webhook_id = $this->webhook_id;

        $query_params['access_token'] = config('services.mercadopago.token');
        $client = new Client([ 'base_uri' => config('services.mercadopago.base_uri') ]);

        $response = $client->request( 'GET', 'v1/payments/' . $webhook_id, [
            'query' => $query_params
        ] );
        $response = json_decode( $response->getBody()->getContents() );

        $pay = Pay::where('preference_id', $response->preference_id)->first();

        $pay->preference_id = $response->payments[0]->id;
        $pay->update();

        if($response->payments[0]->status_detail == 'accredited')
        {
            $pay->status_detail = 'accredited';
            $pay->collection_status = 'Pago recibido';
            $pay->verified_by_sistem = now();
            $pay->update();
            $device = Device::find($pay->device_id);
            $device->monitor_expires_at = $device->monitor_expires_at->addDays($pay->days);
            $device->update();

            MailAlert::create([
                'device_id' => $pay->device_id,
                'user_id' => $pay->user_id,
                'type' => 'PayAccredited',
                'last_created_at' => $device->monitor_expires_at,
            ]);
        }
    }
}
