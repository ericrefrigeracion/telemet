<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendUserMails implements ShouldQueue
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
        if($devices_values = MailAlert::where('send_to_user_at', null)->get())
        {
            foreach ($devices_values as $device_values)
            {
                $user = User::find($device_values->user_id);
                $device = Device::find($device_values->device_id);

                if ($device->send_mails)
                {
                    if ($device_values->type == 'onLine') Mail::to($user->email)->queue(new ConnectMail($device_values, $device, $user));
                    if ($device_values->type == 'offLine') Mail::to($user->email)->queue(new DisconnectMail($device_values, $device, $user));
                    if ($device_values->type == 'temp') Mail::to($user->email)->queue(new TemperatureMail($device_values, $device, $user));
                    if ($device_values->type == 'hum') Mail::to($user->email)->queue(new HumidityMail($device_values, $device, $user));
                    if ($device_values->type == 'tSetPoint') Mail::to($user->email)->queue(new TempSetPointMail($device_values, $device, $user));
                    if ($device_values->type == 'hSetPoint') Mail::to($user->email)->queue(new HumSetPointMail($device_values, $device, $user));
                }
                if($device_values->type == 'MonitorOn') Mail::to($user->email)->queue(new MonitorOnMail($device_values, $device, $user));
                if($device_values->type == 'MonitorOff') Mail::to($user->email)->queue(new MonitorOffMail($device_values, $device, $user));
                if($device_values->type == 'MonitorOffNextDay') Mail::to($user->email)->queue(new MonitorOffNextDayMail($device_values, $device, $user));
                if($device_values->type == 'MonitorOffNextWeek') Mail::to($user->email)->queue(new MonitorOffNextWeekMail($device_values, $device, $user));

                $device_values->send_to_user_at = now();
                $device_values->update();
            }
        }
    }
}
