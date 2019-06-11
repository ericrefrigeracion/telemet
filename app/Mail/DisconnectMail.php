<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisconnectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjet = 'Aviso de equipo desconectado.';
    public $devices_values;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($devices_values)
    {
        $this->devices_values = $devices_values;
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
