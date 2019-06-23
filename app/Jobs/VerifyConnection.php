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

class VerifyConnection implements ShouldQueue
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
        $devices = Device::all()->where('mon', true)->where('admin_mon', true);
        $delay = now()->modify('-10 minute')->format('Y-m-d H:i:s');

        foreach($devices as $device)
        {
            $last_reception = Reception::where('device_id', $device->id)->latest()->first();

            //Si el tiempo de recepcion es menor al delay(o sea mas viejo) && el dispositivo figura en linea
            //en la base de datos(on_line=true)
            if ( $last_reception->created_at < $delay && $device->on_line )
            {
                $device->on_line = 0;
                $device->update();
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'El dispositivo se encuentra desconectado de nuestro servidor hace mas de 10 minutos'
                ]);
                MailAlert::create([
                    'last_data' => $last_reception->data01,
                    'alert_created_at' => $last_reception->created_at,
                    'type' => 'offLine',
                    'send_at' => null,
                    'user_id' => $device->user_id,
                    'device_id' => $device->id,
                ]);

            }

            //Si el tiempo de recepcion es mayor al delay(o sea mas nuevo) && el dispocitivo figura fuera de linea
            //en la base de datos(on_line=false)
            if( $last_reception->created_at > $delay && !$device->on_line )
            {
                $device->on_line = 1;
                $device->update();
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'El dispositivo esta conectado nuevamente'
                ]);
            }
        }
    }
}
