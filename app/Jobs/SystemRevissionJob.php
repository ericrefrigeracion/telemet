<?php

namespace App\Jobs;

use App\Pay;
use App\User;
use App\Alert;
use App\Price;
use App\Device;
use App\Reception;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SystemRevissionJob implements ShouldQueue
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
        $pays = Pay::where('verified_by_system', NULL)->get();
        if($pays->isNotEmpty()) $this->paysVerification($pays);

        $devices = Device::all();
        if($devices->isNotEmpty()) $this->payVigentVerification($devices);

        $this->deleteOldDatas();
        $this->deleteUnverifiedUsers();

        $devices = Device::where('admin_mon', false)->get();
        if($devices->isNotEmpty()) $this->deleteUnmonitorDeviceDatas($devices);
    }

    public function paysVerification($pays)
    {
        $query_params['access_token'] = config('services.mercadopago.token');
        $client = new Client([ 'base_uri' => config('services.mercadopago.base_uri') ]);

        foreach ($pays as $pay)
        {
            $response = $client->request( 'GET', 'v1/payments/' . $pay->payment_id, [
                'query' => $query_params
            ] );

            $response = json_decode( $response->getBody()->getContents() );

            if($response->status_detail == 'accredited')
            {
                $device = Device::find($pay->device_id);
                $price = Price::find($pay->price_id);

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
                alertCreate($device, $log, now());
                mailAlertCreate($device, 'PayAccredited', $device->monitor_expires_at);
            }
        }
    }

    public function payVigentVerification($devices)
    {
        $current_time = now();
        $next_day = now()->addDay();
        $next_week = now()->addWeek();

        foreach ($devices as $device)
        {
            if($device->monitor_expires_at < $current_time && $device->admin_mon)
            {
                $device->update(['admin_mon' => false]);

                alertCreate($device, 'Monitoreo deshabilitado por falta de pago.', $device->monitor_expires_at);
                mailAlertCreate($device, 'MonitorOff',$device->monitor_expires_at);
            }
            if($device->monitor_expires_at >= $current_time && !$device->admin_mon)
            {
                $device->update(['admin_mon' => true]);

                alertCreate($device, 'Monitoreo habilitado nuevamente.', now());
                mailAlertCreate($device, 'MonitorOn',$device->monitor_expires_at);
            }
            if($device->monitor_expires_at < $next_day)
            {
                if(!MailAlert::where('device_id', $device->id)->where('type', 'MonitorOffNextDay')->where('last_created_at', $device->monitor_expires_at)->count())
                {
                    alertCreate($device, 'Mañana se deshabilita monitoreo por falta de pago.', now());
                    mailAlertCreate($device, 'MonitorOffNextDay',$device->monitor_expires_at);
                }
            }
            if($device->monitor_expires_at < $next_week)
            {
                if(!MailAlert::where('device_id', $device->id)->where('type', 'MonitorOffNextWeek')->where('last_created_at', $device->monitor_expires_at)->count())
                {
                    alertCreate($device, 'La semana proxima se deshabilita monitoreo por falta de pago.', now());
                    mailAlertCreate($device, 'MonitorOffNextWeek',$device->monitor_expires_at);
                }
            }
        }
    }

    public function deleteOldDatas()
    {

        Reception::where('created_at', '<', now()->subDays(30))->delete();
        Alert::where('created_at', '<', now()->subDays(90))->delete();
    }

    public function deleteUnmonitorDeviceDatas($devices)
    {
        foreach ($devices as $device)
        {
            $last_day = now()->subDay();
            $device->receptions()->where('created_at', '<', $last_day)->delete();
            $device->alerts()->where('created_at', '<', $last_day)->delete();
        }
    }

    public function deleteUnverifiedUsers()
    {
        User::where('email_verified_at', null)->where('created_at', '<', now()->subDay())->delete();
    }


}
