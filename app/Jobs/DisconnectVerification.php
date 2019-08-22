<?php

namespace App\Jobs;

use App\Alert;
use App\Device;
use App\MailAlert;
use App\Reception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DisconnectVerification implements ShouldQueue
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
        $devices = Device::where('admin_mon', true)->get();
        $delay = now()->subMinutes(10);

        foreach($devices as $device)
        {
            $last_reception = $device->receptions()->latest()->first();

            //Si el tiempo de recepcion es menor al delay(o sea mas viejo) && el dispositivo figura en linea
            //en la base de datos(on_line=true)
            if ( $last_reception->created_at < $delay && $device->on_line )
            {
                $device->on_line = false;
                $device->update();
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'Ultima conexion del dispositivo.',
                    'alert_created_at' => $last_reception->created_at,
                ]);
                MailAlert::create([
                    'last_data' => $last_reception->data01,
                    'last_created_at' => $last_reception->created_at,
                    'type' => 'offLine',
                    'user_id' => $device->user_id,
                    'device_id' => $device->id,
                ]);

            }

            //Si el tiempo de recepcion es mayor al delay(o sea mas nuevo) && el dispocitivo figura fuera de linea
            //en la base de datos(on_line=false)
            if( $last_reception->created_at > $delay && !$device->on_line )
            {
                $device->on_line = true;
                $device->update();
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'El dispositivo se conecto nuevamente.',
                    'alert_created_at' => $last_reception->created_at,
                ]);
                MailAlert::create([
                    'last_data' => $last_reception->data01,
                    'last_created_at' => $last_reception->created_at,
                    'type' => 'onLine',
                    'user_id' => $device->user_id,
                    'device_id' => $device->id,
                ]);
            }
        }
    }
}
