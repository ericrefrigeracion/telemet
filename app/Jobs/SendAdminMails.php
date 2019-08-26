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
use App\Mail\AdminConnectMail;
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

class SendAdminMails implements ShouldQueue
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
        if($mails_information = MailAlert::where('send_to_admin_at', null)->get())
        {
            $eric = User::find(1);
            $carlos = User::find(2);

            foreach ($mails_information as $mail_information)
            {
                $user = User::find($mail_information->user_id);
                $device = Device::find($mail_information->device_id);

                if ($mail_information->type == 'onLine')
                {
                    Mail::to($eric->email)->queue(new AdminConnectMail($mail_information, $device, $user));
                    Mail::to($carlos->email)->queue(new AdminConnectMail($mail_information, $device, $user));
                }
                if ($mail_information->type == 'offLine')
                {
                    Mail::to($eric->email)->queue(new AdminDisconnectMail($mail_information, $device, $user));
                    Mail::to($carlos->email)->queue(new AdminDisconnectMail($mail_information, $device, $user));
                }
                if ($mail_information->type == 'temp')
                {
                    Mail::to($eric->email)->queue(new AdminTemperatureMail($mail_information, $device, $user));
                    Mail::to($carlos->email)->queue(new AdminTemperatureMail($mail_information, $device, $user));
                }
                if ($mail_information->type == 'hum')
                {
                    Mail::to($eric->email)->queue(new AdminHumidityMail($mail_information, $device, $user));
                    Mail::to($carlos->email)->queue(new AdminHumidityMail($mail_information, $device, $user));
                }
                if ($mail_information->type == 'tSetPoint')
                {
                    Mail::to($eric->email)->queue(new AdminTempSetPointMail($mail_information, $device, $user));
                    Mail::to($carlos->email)->queue(new AdminTempSetPointMail($mail_information, $device, $user));
                }
                if ($mail_information->type == 'hSetPoint')
                {
                    Mail::to($eric->email)->queue(new AdminHumSetPointMail($mail_information, $device, $user));
                    Mail::to($carlos->email)->queue(new AdminHumSetPointMail($mail_information, $device, $user));
                }
                $mail_information->send_to_admin_at = now();
                $mail_information->update();
            }
        }
    }
}
