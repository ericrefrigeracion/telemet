<?php

namespace App\Jobs;

use App\Pay;
use App\Price;
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

    public $payment_id;
    public $tries = 5;
    public $timeout = 30;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payment_id)
    {
         $this->payment_id = $payment_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payment_id = $this->payment_id;

        $query_params['access_token'] = config('services.mercadopago.token');
        $client = new Client([ 'base_uri' => config('services.mercadopago.base_uri') ]);

        $response = $client->request( 'GET', 'v1/payments/' . $payment_id, [
            'query' => $query_params
        ] );
        $response = json_decode( $response->getBody()->getContents() );

        $pay = Pay::where('payment_id', $pay->payment_id)->first();
        $pay->operation_type = $response->operation_type;
        $pay->detail = $response->status_detail;
        $pay->update();

        if($pay->detail == 'accredited')
        {
            $pay->status = 'Pago recibido';
            $pay->verified_by_system = now();
            $pay->update();
            $device = Device::find($pay->device_id);
            $price = Price::find($pay->price_id);
            $device->monitor_expires_at = $device->monitor_expires_at->addDays($price->days);
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
