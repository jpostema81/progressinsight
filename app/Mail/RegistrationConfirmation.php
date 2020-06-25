<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($activationToken)
    {
        $this->activationToken = $activationToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = secure_url("/register/$this->activationToken/activate");

        return $this->markdown('mails.registration_confirmation')->with([
            'activationLink' => $url,
        ])->subject('Bevestig je registratie op ' . config('app.name'));
    }
}
