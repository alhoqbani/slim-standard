<?php

namespace App\Services\Mail;

use App\Services\Mail\Mailer\Mailable;
use App\Models\User;

class ResetPassword extends Mailable
{
    
    /**
     * @var \App\Models\User
     */
    protected $user;
    /**
     * @var
     */
    private $token;
    
    /**
     * Welcome constructor.
     *
     * @param \App\Models\User $user
     * @param                  $token
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
    
    public function build()
    {
        return $this->subject("Reset Your Password {$this->user->name}")
            ->view('emails/reset_password.twig')
            ->with([
                'user'  => $this->user,
                'token' => $this->token,
            ]);
    }
}