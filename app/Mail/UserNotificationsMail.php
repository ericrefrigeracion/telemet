<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserNotificationsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Notificaciones de las ultimas 24hs.';
    public $alerts;
    public $device;
    public $tries = 5;
    public $timeout = 30;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($alerts, $device)
    {
        $this->alerts = $alerts;
        $this->device = $device;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notificaciones@telemet.com.ar')->markdown('email.centinela.users.notifications');
    }
}