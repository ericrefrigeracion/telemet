<?php

namespace App\Jobs;

use App\Device;
use App\Reception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SetPointHumChangeVerification implements ShouldQueue
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

            if($last_reception->data02 > $device->h_set_point && $device->h_is === 'lower')
            {
                $device->h_is = 'higher';
                $device->h_change_at = now();
                $device->update();
            }
            if($last_reception->data02 < $device->h_set_point && $device->h_is === 'higher')
            {
                $device->h_is = 'lower';
                $device->h_change_at = now();
                $device->update();
            }
        }
    }
}
