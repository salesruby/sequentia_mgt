<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $token;

    /**
     * ForgotPasswordMail constructor.
     * @param $user
     * @param $token
     */

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Password Recovery')->from('bgc@salesruby.com')
            ->view('email.forgotPassword');
    }
}
