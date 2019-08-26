<?php

namespace App\Jobs;

use App\Device;
use App\MailAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PayVigentVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $devices = Device::all();
        $current_time = now();
        $next_day = now()->addDay();
        $next_week = now()->addWeek();

        foreach ($devices as $device)
        {
            if($device->monitor_expires_at < $current_time && $device->admin_mon)
            {
                $device->admin_mon = false;
                $device->update();

                MailAlert::create([
                    'device_id' => $device->id,
                    'user_id' => $device->user_id,
                    'type' => 'MonitorOff',
                    'last_created_at' => $device->monitor_expires_at,
                ]);
            }
            if($device->monitor_expires_at >= $current_time && !$device->admin_mon)
            {
                $device->admin_mon = true;
                $device->update();

                MailAlert::create([
                    'device_id' => $device->id,
                    'user_id' => $device->user_id,
                    'type' => 'MonitorOn',
                    'last_created_at' => $device->monitor_expires_at,
                ]);
            }
            if($device->monitor_expires_at < $next_day)
            {
                if(!MailAlert::where('device_id', $device->id)->where('type', 'MonitorOffNextDay')->where('last_created_at', $device->monitor_expires_at)->count())
                {
                    MailAlert::create([
                        'device_id' => $device->id,
                        'user_id' => $device->user_id,
                        'type' => 'MonitorOffNextDay',
                        'last_created_at' => $device->monitor_expires_at,
                    ]);
                }
            }
            if($device->monitor_expires_at < $next_week)
            {
                if(!MailAlert::where('device_id', $device->id)->where('type', 'MonitorOffNextWeek')->where('last_created_at', $device->monitor_expires_at)->count())
                {
                    MailAlert::create([
                        'device_id' => $device->id,
                        'user_id' => $device->user_id,
                        'type' => 'MonitorOffNextWeek',
                        'last_created_at' => $device->monitor_expires_at,
                    ]);
                }
            }
        }

    }
}
