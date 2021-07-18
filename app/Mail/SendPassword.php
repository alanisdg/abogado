<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $userDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userDetails)
    {
        $this->userDetails = $userDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'test@mail.com';
        $name = 'Appaboproc';
        $noReply = "No responder este correo.";
        $subject = 'Notificación de Recepción de Contraseña';

        return $this->view('emails.send-password')
                    ->from($address, $name)
                    ->replyTo("no-reply@sasfa.cl", $noReply)
                    ->subject($subject);
    }
}
