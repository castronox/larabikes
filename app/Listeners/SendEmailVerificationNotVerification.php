<?php

namespace App\Listeners;
use App\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailVerificationNotVerification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        if(
            $event->user instanceof MustVerifyEmail &&
            !$event->user->hasVerifiedEmail()
        ){
            $event->user->sendEmailVerificationNotification();
        }
    }
}
