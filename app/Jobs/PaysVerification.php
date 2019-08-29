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

class PaysVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 30;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pays = Pay::where('verified_by_sistem', NULL)->get();
        $query_params['access_token'] = config('services.mercadopago.token');
        $client = new Client([ 'base_uri' => config('services.mercadopago.base_uri') ]);

        foreach ($pays as $pay)
        {
            if($pay->collection_id)
            {
               $response = $client->request( 'GET', 'v1/payments/' . $pay->collection_id, [
                    'query' => $query_params
                ] );

                $response = json_decode( $response->getBody()->getContents() );

                $pay->status_detail = $response->status_detail;
                $pay->update();

                if($response->status_detail == 'accredited')
                {
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
    }
}
