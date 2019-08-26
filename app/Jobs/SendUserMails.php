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
        if($mails_information = MailAlert::where('send_to_user_at', null)->get())
        {
            foreach ($mails_information as $mail_information)
            {
                $user = User::find($mail_information->user_id);
                $device = Device::find($mail_information->device_id);

                if ($device->send_mails)
                {
                    if ($mail_information->type == 'onLine') Mail::to($user->email)->queue(new ConnectMail($mail_information, $device, $user));
                    if ($mail_information->type == 'offLine') Mail::to($user->email)->queue(new DisconnectMail($mail_information, $device, $user));
                    if ($mail_information->type == 'temp') Mail::to($user->email)->queue(new TemperatureMail($mail_information, $device, $user));
                    if ($mail_information->type == 'hum') Mail::to($user->email)->queue(new HumidityMail($mail_information, $device, $user));
                    if ($mail_information->type == 'tSetPoint') Mail::to($user->email)->queue(new TempSetPointMail($mail_information, $device, $user));
                    if ($mail_information->type == 'hSetPoint') Mail::to($user->email)->queue(new HumSetPointMail($mail_information, $device, $user));
                }
                if($mail_information->type == 'MonitorOn') Mail::to($user->email)->queue(new MonitorOnMail($mail_information, $device, $user));
                if($mail_information->type == 'MonitorOff') Mail::to($user->email)->queue(new MonitorOffMail($mail_information, $device, $user));
                if($mail_information->type == 'MonitorOffNextDay') Mail::to($user->email)->queue(new MonitorOffNextDayMail($mail_information, $device, $user));
                if($mail_information->type == 'MonitorOffNextWeek') Mail::to($user->email)->queue(new MonitorOffNextWeekMail($mail_information, $device, $user));

                $mail_information->send_to_user_at = now();
                $mail_information->update();
            }
        }
    }
}