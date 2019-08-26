<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TempSetPointMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Aviso de temperatura deseada no alcanzada.';
    public $device_values;
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
        return $this->from('telemett@alertas-humedad.com')->markdown('email.centinela.users.temp_set_point');
    }
}