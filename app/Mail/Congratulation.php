<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Bike;

class Congratulation extends Mailable{

    use Queueable, SerializesModels;

    public $bike;

    public function __construct(Bike $bike){
        $this->bike = $bike;
    }

    public function build(){
        return $this->from('no_reply@larabikes.com')
                ->subject('¡ Felicidades !')
                ->view('emails.congratulation');
    }
}