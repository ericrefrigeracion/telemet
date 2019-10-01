<?php

namespace App\Jobs\Temperature;

use App\Device;
use App\Reception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SetPointTempChangeVerification implements ShouldQueue
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

            if($last_reception->data01 > $device->tiny_t_device->t_set_point && $device->tiny_t_device->t_is === 'lower')
            {
                $device->tiny_t_device->t_is = 'higher';
                $device->tiny_t_device->t_change_at = $last_reception->created_at;
                $device->tiny_t_device->update();
            }
            if($last_reception->data01 < $device->tiny_t_device->t_set_point && $device->tiny_t_device->t_is === 'higher')
            {
                $device->tiny_t_device->t_is = 'lower';
                $device->tiny_t_device->t_change_at = $last_reception->tiny_t_device->created_at;
                $device->tiny_t_device->update();
            }
        }
    }
}
