<?php

namespace App\Jobs\SetPoint;

use App\Alert;
use App\Device;
use App\Reception;
use App\MailAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TimeSetPointVerification implements ShouldQueue
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
            $delay = now()->subMinutes($device->tiny_t_device->tdly);

            if ($device->tiny_t_device->t_change_at <= $delay && $device->tiny_t_device->on_t_set_point)
            {
                $device->tiny_t_device->on_t_set_point = false;
                $device->tiny_t_device->update();

                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La temperatura no alcanzo el valor deseado en el tiempo previsto.',
                    'alert_created_at' => $device->tiny_t_device->t_change_at,
                ]);

                MailAlert::create([
                    'device_id' => $device->id,
                    'user_id' => $device->user_id,
                    'type' => 'tSetPoint',
                    'last_created_at' => $device->tiny_t_device->t_change_at,
                ]);
            }
            if ($device->tiny_t_device->t_change_at > $delay && !$device->tiny_t_device->on_t_set_point)
            {
                $device->tiny_t_device->on_t_set_point = true;
                $device->tiny_t_device->update();
            }
        }
    }
}
