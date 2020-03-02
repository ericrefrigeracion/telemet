<?php

namespace App\Jobs\Mail;

use App\User;
use App\Alert;
use App\Device;
use App\MailAlert;
use App\Mail\UserNotificationsMail;
use App\Mail\PayAccreditedMail;
use App\Mail\MonitorOnMail;
use App\Mail\MonitorOffMail;
use App\Mail\MonitorOffNextDayMail;
use App\Mail\MonitorOffNextWeekMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
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
        $devices = Device::where('admin_mon', true)->where('notification_email', '!=', 'No quiero recibir notificaciones')->get();
        if($devices->isNotEmpty()) $this->sendAlertsMail($devices);

        $mail_alerts = MailAlert::where('send_to_user_at', null)->get();
        if($mail_alerts->isNotEmpty()) $this->sendMailAlertsMail($mail_alerts);
    }

    public function sendAlertsMail($devices)
    {
        $yesterday = now()->subDay();
        foreach ($devices as $device)
        {
            $alerts = $device->alerts()->where('created_at', '>', $yesterday)->get();
            if($alerts->isNotEmpty()) Mail::to($device->notification_email)->queue(new UserNotificationsMail($alerts, $device));
        }
    }

    public function sendMailAlertsMail($mail_alerts)
    {
        foreach ($mail_alerts as $mail_alert)
        {
            $user = User::find($mail_alert->user_id);
            $device = Device::find($mail_alert->device_id);

            if($mail_alert->type == 'PayAccredited')
            {
                Mail::to($device->notification_email)->queue(new PayAccreditedMail($mail_alert, $device, $user));
                $mail_alert->update(['send_to_user_at' => now()]);
            }
            if($mail_alert->type == 'MonitorOn')
            {
                Mail::to($device->notification_email)->queue(new MonitorOnMail($mail_alert, $device, $user));
                $mail_alert->update(['send_to_user_at' => now()]);
            }
            if($mail_alert->type == 'MonitorOff')
            {
                Mail::to($device->notification_email)->queue(new MonitorOffMail($mail_alert, $device, $user));
                $mail_alert->update(['send_to_user_at' => now()]);
            }
            if($mail_alert->type == 'MonitorOffNextDay')
            {
                Mail::to($device->notification_email)->queue(new MonitorOffNextDayMail($mail_alert, $device, $user));
                $mail_alert->update(['send_to_user_at' => now()]);
            }
            if($mail_alert->type == 'MonitorOffNextWeek')
            {
                Mail::to($device->notification_email)->queue(new MonitorOffNextWeekMail($mail_alert, $device, $user));
                $mail_alert->update(['send_to_user_at' => now()]);
            }
        }
    }

}