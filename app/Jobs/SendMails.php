<?php

namespace App\Jobs;

use App\User;
use App\Device;
use App\MailAlert;
use App\Mail\ConnectMail;
use App\Mail\HumidityMail;
use App\Mail\DisconnectMail;
use App\Mail\TemperatureMail;
use App\Mail\HumSetPointMail;
use App\Mail\TempSetPointMail;
use App\Mail\AdminHumidityMail;
use App\Mail\AdminDisconnectMail;
use App\Mail\AdminTemperatureMail;
use App\Mail\AdminHumSetPointMail;
use App\Mail\AdminTempSetPointMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMails implements ShouldQueue
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
        if($devices_values = MailAlert::where('send_at', null)->get())
        {
            $eric = User::find(1);
            $carlos = User::find(2);

            foreach ($devices_values as $device_values)
            {
                $user = User::find($device_values->user_id);
                $device = Device::find($device_values->device_id);

                $device_values->send_at = now();
                $device_values->update();

                if ($device_values->type == 'offLine')
                {
                    if($device->send_mails) Mail::to($user->notification_mail)->queue(new ConnectMail($device_values, $device, $user));
                    Mail::to($eric->notification_mail)->queue(new AdminConnectMail($device_values, $device, $user));
                    Mail::to($carlos->notification_mail)->queue(new AdminConnectMail($device_values, $device, $user));
                }
                if ($device_values->type == 'offLine')
                {
                    if($device->send_mails) Mail::to($user->notification_mail)->queue(new DisconnectMail($device_values, $device, $user));
                    Mail::to($eric->notification_mail)->queue(new AdminDisconnectMail($device_values, $device, $user));
                    Mail::to($carlos->notification_mail)->queue(new AdminDisconnectMail($device_values, $device, $user));
                }
                if ($device_values->type == 'temp')
                {
                    if($device->send_mails) Mail::to($user->notification_mail)->queue(new TemperatureMail($device_values, $device, $user));
                    Mail::to($eric->notification_mail)->queue(new AdminTemperatureMail($device_values, $device, $user));
                    Mail::to($carlos->notification_mail)->queue(new AdminTemperatureMail($device_values, $device, $user));
                }
                if ($device_values->type == 'hum')
                {
                    if($device->send_mails) Mail::to($user->notification_mail)->queue(new HumidityMail($device_values, $device, $user));
                    Mail::to($eric->notification_mail)->queue(new AdminHumidityMail($device_values, $device, $user));
                    Mail::to($carlos->notification_mail)->queue(new AdminHumidityMail($device_values, $device, $user));
                }
                if ($device_values->type == 'tSetPoint')
                {
                    if($device->send_mails) Mail::to($user->notification_mail)->queue(new TempSetPointMail($device_values, $device, $user));
                    Mail::to($eric->notification_mail)->queue(new AdminTempSetPointMail($device_values, $device, $user));
                    Mail::to($carlos->notification_mail)->queue(new AdminTempSetPointMail($device_values, $device, $user));
                }
                if ($device_values->type == 'hSetPoint')
                {
                    if($device->send_mails) Mail::to($user->notification_mail)->queue(new HumSetPointMail($device_values, $device, $user));
                    Mail::to($eric->notification_mail)->queue(new AdminHumSetPointMail($device_values, $device, $user));
                    Mail::to($carlos->notification_mail)->queue(new AdminHumSetPointMail($device_values, $device, $user));
                }
            }
        }
    }
}
