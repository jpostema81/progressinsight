<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $activationToken;
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
        $url = secure_url("/invitations/$this->activationToken/activate");

        return $this->markdown('mails.new_user_invitation')->with([
            'activationLink' => $url,
        ])->subject('Uitnodiging ' . config('app.name'));
    }
}
