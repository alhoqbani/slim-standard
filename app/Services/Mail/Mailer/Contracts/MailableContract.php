<?php

namespace App\Services\Mail\Mailer\Contracts;

use App\Services\Mail\Mailer\Mailer;

interface MailableContract
{
    
    public function send(Mailer $mailer);
}