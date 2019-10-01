<?php

namespace App\Jobs\Temperature;

use App\Alert;
use App\Device;
use App\Reception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MaxTempVerification implements ShouldQueue
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
        $devices = Device::where('admin_mon', true)->where('on_line', true)->where('protected', true)->get();

        foreach($devices as $device)
        {
            $last_reception = $device->receptions()->latest()->first();
            $last_reception->data01 += $device->tiny_t_device->tcal;

            if($last_reception->data01 > $device->tiny_t_device->tmax && $device->tiny_t_device->on_temp)
            {
                $device->tiny_t_device->on_temp = false;
                $device->tiny_t_device->t_out_at = $last_reception->created_at;
                $device->tiny_t_device->update();

                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La temperatura se encuentra por encima de la maxima permitida.',
                    'alert_created_at' => $last_reception->created_at
                ]);
            }
            if($last_reception->data01 < $device->tiny_t_device->tmax && $last_reception->data01 > $device->tiny_t_device->tmin && !$device->tiny_t_device->on_temp)
            {
                $device->on_temp = true;
                $device->t_out_at = null;
                $device->update();
            }
        }
    }
}
