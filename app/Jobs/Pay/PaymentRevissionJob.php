<?php

namespace App\Jobs\Pay;

use App\Pay;
use App\Alert;
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
    public $user_id;
    public $device_id;
    public $price_id;
    public $tries = 5;
    public $timeout = 30;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payment_id, $user_id, $device_id, $price_id)
    {
         $this->payment_id = $payment_id;
         $this->user_id = $user_id;
         $this->device_id = $device_id;
         $this->price_id = $price_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payment_id = $this->payment_id;
        $user_id = $this->user_id;
        $device_id = $this->device_id;
        $price_id = $this->price_id;

        $query_params['access_token'] = config('services.mercadopago.token');
        $client = new Client([ 'base_uri' => config('services.mercadopago.base_uri') ]);

        $response = $client->request( 'GET', 'v1/payments/' . $payment_id, [
            'query' => $query_params
        ] );
        $response = json_decode( $response->getBody()->getContents() );

        if(!$pay = Pay::where('payment_id', $payment_id)->first())
        {
            if($response->status_detail == 'accredited')
            {
                $device = Device::find($device_id);
                $price = Price::find($price_id);
                if($device->monitor_expires_at < now()) $device->monitor_expires_at = now();
                $period_start = $device->monitor_expires_at;
                $device->monitor_expires_at = $device->monitor_expires_at->addDays($price->days);
                $period_finish = $device->monitor_expires_at;
                $device->update();
                Pay::create([
                    'user_id' => $user_id,
                    'device_id' => $device_id,
                    'price_id' => $price_id,
                    'payment_id' => $payment_id,
                    'payment_type' => $response->payment_type_id,
                    'status' => 'Pago recibido',
                    'detail' => 'Acreditado',
                    'operation_type' => $response->operation_type,
                    'period_start' => $period_start,
                    'period_finish' => $period_finish,
                    'verified_by_system' => now(),
                ]);

                $log = 'Pago N°' . $payment_id . ' acreditado.';
                AlertCreate($device, $log, now());
                MailAlertCreate($device, 'PayAccredited', $device->monitor_expires_at);

            }
            else
            {
                Pay::create([
                    'user_id' => $user_id,
                    'device_id' => $device_id,
                    'price_id' => $price_id,
                    'payment_id' => $payment_id,
                    'payment_type' => $response->payment_type_id,
                    'status' => 'Pago recibido (Pendiente)',
                    'detail' => 'Pendiente de acreditacion',
                    'operation_type' => $response->operation_type,
                ]);
            }
        }
        else
        {
            if($response->status_detail == 'accredited' && $pay->verified_by_system == NULL)
            {
                $device = Device::find($device_id);
                $price = Price::find($price_id);
                if($device->monitor_expires_at < now()) $device->monitor_expires_at = now();
                $period_start = $device->monitor_expires_at;
                $device->monitor_expires_at = $device->monitor_expires_at->addDays($price->days);
                $period_finish = $device->monitor_expires_at;
                $device->update();

                $pay->status = 'Pago recibido';
                $pay->detail = 'Acreditado';
                $pay->period_start = $period_start;
                $pay->period_finish = $period_finish;
                $pay->verified_by_system = now();
                $pay->update();

                $log = 'Pago N°' . $payment_id . ' acreditado.';
                AlertCreate($device, $log, now());
                MailAlertCreate($device, 'PayAccredited', $device->monitor_expires_at);
            }
        }
    }
}
