<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisconnectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Aviso de equipo desconectado.';
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
    public function __construct($device_values, $device, $user)
    {
        $this->device_values = $device_values;
        $this->device = $device;
        $this->user = $user;
    }

    /**
     * Build the devices_values.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('telemet@alertas-desconexion.com')->markdown('email.centinela.disconnect');
    }
}
