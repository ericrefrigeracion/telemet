<?php

namespace App\Jobs;

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
        $devices = Device::all()->where('tmon', true)->where('admin_mon', true)->where('on_line', true);

        foreach($devices as $device)
        {
            $last_reception = $device->receptions()->latest()->first();

            if($last_reception->data01 > $device->t_set_point && $device->t_is === 'lower')
            {
                $device->t_is = 'higher';
                $device->t_change_at = now();
                $device->update();
            }
            if($last_reception->data01 < $device->t_set_point && $device->t_is === 'higher')
            {
                $device->t_is = 'lower';
                $device->t_change_at = now();
                $device->update();
            }
        }
    }
}
