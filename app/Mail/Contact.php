<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje; // Objecto que contendrá toda la info


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email =  $this->from($this->mensaje->email)
                    ->subject('Mensaje recibido:'. $this->mensaje->asunto)
                    ->with('centro', 'CIFO Sabadell')
                    ->view('emails.contact');

        # Si hay un fichero, lo adjuntamos
        if($this->mensaje->fichero)
            $email->attach($this->mensaje->fichero,[
                'as' => 'adjunto_'.uniqid().'.pdf',   # Nombre único
                'mime' => 'application/pdf',
            ]);

        return $email;
    }
}
