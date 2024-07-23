<?php

namespace App\Services;

use App\Interfaces\SendInterface;
use App\Mail\PaymentMail;
use App\Mail\UserRegisteredMail;

class MailService implements SendInterface
{

    public function send($type, $data)
    {
        return match ($type) {
            'user_registered' => new UserRegisteredMail($data),
            'payment' => new PaymentMail($data),
            default => throw new \Exception('Unknown mail type'),
        };
    }
}
