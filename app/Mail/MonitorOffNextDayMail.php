<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MonitorOffNextDayMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Mañana se deshabilita el monitoreo.';
    public $mail_information;
    public $device;
    public $user;
    public $tries = 5;
    public $timeout = 30;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_information, $device, $user)
    {
        $this->mail_information = $mail_information;
        $this->device = $device;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('alertas-vencimiento@telemet.com')->markdown('email.centinela.users.mon_off_next_day');
    }
}
