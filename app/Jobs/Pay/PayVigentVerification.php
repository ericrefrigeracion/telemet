<?php

namespace App\Jobs\Pay;

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
        $devices = Device::all();
        $current_time = now();
        $next_day = now()->addDay();
        $next_week = now()->addWeek();

        foreach ($devices as $device)
        {
            if($device->monitor_expires_at < $current_time && $device->admin_mon)
            {
                $device->update(['admin_mon' => false]);
                alertCreate($device, 'Monitoreo deshabilitado por falta de pago.', $device->monitor_expires_at);
                mailAlertCreate($device, 'MonitorOff', $device->monitor_expires_at);
            }
            if($device->monitor_expires_at >= $current_time && !$device->admin_mon)
            {
                $device->update(['admin_mon' => true]);
                alertCreate($device, 'Monitoreo habilitado nuevamente.', now());
                mailAlertCreate($device, 'MonitorOn', $device->monitor_expires_at);
            }
            if($device->monitor_expires_at < $next_day)
            {
                if(!MailAlert::where('device_id', $device->id)->where('type', 'MonitorOffNextDay')->where('last_created_at', $device->monitor_expires_at)->count())
                {
                    alertCreate($device, 'Mañana se deshabilita monitoreo por falta de pago.', now());
                    mailAlertCreate($device, 'MonitorOffNextDay', $device->monitor_expires_at);
                }
            }
            if($device->monitor_expires_at < $next_week)
            {
                if(!MailAlert::where('device_id', $device->id)->where('type', 'MonitorOffNextWeek')->where('last_created_at', $device->monitor_expires_at)->count())
                {
                    alertCreate($device, 'La semana proxima se deshabilita monitoreo por falta de pago.', now());
                    mailAlertCreate($device, 'MonitorOffNextWeek', $device->monitor_expires_at);
                }
            }
        }

    }
}
