<?php

namespace App\Jobs;

use App\User;
use App\MailAlert;
use App\Mail\DisconnectMail;
use App\Mail\TemperatureMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
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
        if($devices_values = MailAlert::all())
        {
            foreach ($devices_values as $device_values)
            {
                $user = User::find($device_values->user_id);
                if ($device_values->type == 'temp')
                {
                    Mail::to($user->notification_mail)->queue(new TemperatureMail($devices_values));
                    Mail::to('ericlopezrefrigeracion@hotmail.com')->queue(new TemperatureMail($devices_values));
                    Mail::to('carlosgavernet@gmail.com')->queue(new TemperatureMail($devices_values));
                    $device_values->send_at = now();
                    $device_values->update();
                }
                if ($device_values->type == 'offLine')
                {
                    Mail::to($user->notification_mail)->queue(new DisconnectMail($devices_values));
                    Mail::to('ericlopezrefrigeracion@hotmail.com')->queue(new DisconnectMail($devices_values));
                    Mail::to('carlosgavernet@gmail.com')->queue(new DisconnectMail($devices_values));
                    $device_values->send_at = now();
                    $device_values->update();
                }
            }
        }
    }
}
