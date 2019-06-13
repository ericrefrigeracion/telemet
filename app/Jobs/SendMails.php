<?php

namespace App\Jobs;

use App\User;
use App\Device;
use App\MailAlert;
use App\Mail\DisconnectMail;
use App\Mail\TemperatureMail;
use App\Mail\AdminDisconnectMail;
use App\Mail\AdminTemperatureMail;
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
            foreach ($devices_values as $device_values)
            {
                $user = User::find($device_values->user_id);
                $device = Device::find($device_values->device_id);

                $device_values->send_at = now();
                $device_values->update();

                if ($device_values->type == 'temp')
                {
                    Mail::to($user->notification_mail)->queue(new TemperatureMail($device_values, $device, $user));
                    Mail::to('ericlopezrefrigeracion@hotmail.com')->queue(new AdminTemperatureMail($device_values, $device, $user));
                    Mail::to('carlosgavernet@gmail.com')->queue(new AdminTemperatureMail($device_values, $device, $user));
                }
                if ($device_values->type == 'offLine')
                {
                    Mail::to($user->notification_mail)->queue(new DisconnectMail($device_values, $device, $user));
                    Mail::to('ericlopezrefrigeracion@hotmail.com')->queue(new AdminDisconnectMail($device_values, $device, $user));
                    Mail::to('carlosgavernet@gmail.com')->queue(new AdminDisconnectMail($device_values, $device, $user));
                }
            }
        }
    }
}
