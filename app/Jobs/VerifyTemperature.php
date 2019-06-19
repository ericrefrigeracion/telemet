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

class VerifyTemperature implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
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
        $devices = Device::all()->where('tmon', true)->where('admin_mon', true)->where('on_line', true);

        foreach($devices as $device)
        {
            $last_reception = Reception::where('device_id', $device->id)->latest()->first();

            //condiciones para empezar a MIRAR los dispocitivos
            if ($last_reception->data01 < $device->tmin && $device->twatch === null)
            {
                $device->twatch = $last_reception->created_at;
                $device->update();
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La temperatura se encuentra por debajo de la minima permitida.',
                    'alert_created_at' => $last_reception->created_at
                ]);
            }
            if ($last_reception->data01 > $device->tmax && $device->twatch === null)
            {
                $device->twatch = $last_reception->created_at;
                $device->update();
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La temperatura se encuentra por encima de la maxima permitida.',
                    'alert_created_at' => $last_reception->created_at
                ]);
            }
            if ($last_reception->data01 < $device->tmax && $last_reception->data01 > $device->tmin && $device->twatch != null)
            {
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La temperatura se encuentra dentro de los parametros normales nuevamente.',
                    'alert_created_at' => $last_reception->created_at
                ]);
                $device->twatch = null;
                $device->update();
            }

            //condicion de tiempo
            if ($device->twatch){
                $twatch = $device->twatch->addMinutes($device->tdly);
                if ($twatch <= now())
                {   //si el envio de mails esta activo

                    MailAlert::create([
                        'last_data01' => $last_reception->data01,
                        'last_created_at' => $device->watch,
                        'type' => 'temp',
                        'send_at' => null,
                        'user_id' => $device->user_id,
                        'device_id' => $device->id
                    ]);
                    Alert::create([
                        'device_id' => $device->id,
                        'log' => 'Se envio el E-mail correspondiente alertando de la falla.',
                        'alert_created_at' => now()
                    ]);

                }
            }
        }

    }
}
