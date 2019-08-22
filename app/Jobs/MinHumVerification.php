<?php

namespace App\Jobs;

use App\Alert;
use App\Device;
use App\Reception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MinHumVerification implements ShouldQueue
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
            $last_reception = $device->receptions()->latest()->first();

            if($last_reception->data02 < $device->hmin && $device->on_hum)
            {
                $device->on_hum = false;
                $device->h_out_at = $last_reception->created_at;
                $device->update();

                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La humedad se encuentra por debajo de la minima permitida.',
                    'alert_created_at' => $last_reception->created_at
                ]);
            }
            if($last_reception->data02 < $device->hmax && $last_reception->data02 > $device->hmin && !$device->on_hum)
            {
                $device->on_hum = true;
                $device->h_out_at = null;
                $device->update();
            }
        }
    }
}
