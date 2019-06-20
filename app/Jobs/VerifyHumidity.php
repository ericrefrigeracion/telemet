<?php

namespace App\Jobs;

use App\Alert;
use App\Device;
use App\Reception;
use App\MailAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class VerifyHumidity implements ShouldQueue
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
        $devices = Device::all()->where('hmon', true)->where('admin_mon', true)->where('on_line', true);

        foreach($devices as $device)
        {
            $last_reception = Reception::where('device_id', $device->id)->latest()->first();

            //condiciones para empezar a MIRAR los dispocitivos
            if ($last_reception->data02 < $device->hmin && $device->hwatch === null)
            {
                $device->hwatch = $last_reception->created_at;
                $device->update();
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La humedad se encuentra por debajo de la minima permitida.',
                    'alert_created_at' => $last_reception->created_at
                ]);
            }
            if ($last_reception->data02 > $device->hmax && $device->hwatch === null)
            {
                $device->hwatch = $last_reception->created_at;
                $device->update();
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La humedad se encuentra por encima de la maxima permitida.',
                    'alert_created_at' => $last_reception->created_at
                ]);
            }
            //condicion para dejar de MIRAR a los dispositivos
            if ($last_reception->data02 < $device->hmax && $last_reception->data02 > $device->hmin && $device->hwatch != null)
            {
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La humedad se encuentra dentro de los parametros normales nuevamente.',
                    'alert_created_at' => $last_reception->created_at
                ]);
                $device->hwatch = null;
                $device->update();
            }

            //condicion de tiempo
            if ($device->hwatch){
                $watch = $device->hwatch->addMinutes($device->hdly);
                if ($watch <= now())
                {
                    MailAlert::create([
                        'last_data01' => $last_reception->data02,
                        'last_created_at' => $device->hwatch,
                        'type' => 'hum',
                        'send_at' => null,
                        'user_id' => $device->user_id,
                        'device_id' => $device->id
                    ]);
                    Alert::create([
                        'device_id' => $device->id,
                        'log' => 'Se envio el E-mail correspondiente alertando de la falla por humedad.',
                        'alert_created_at' => now()
                    ]);
                }
            }
        }
    }
}
