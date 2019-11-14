<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user.
     * @var \Illuminate\Contracts\Auth\Authenticatable $user
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function __construct($user)
    {	
    	$this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('AkkarachaiWangcharoensap@gmail.com')
        			->view('templates.mail.reset-password');
    }
}
