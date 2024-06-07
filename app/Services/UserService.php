<?php

namespace App\Services;

use App\Events\EmailSentEvent;
use App\Jobs\EmailJob;

class UserService
{
    public function dispatchEmailJob($user) {
        EmailJob::dispatch($user)->delay(now()->addSeconds(10));
    }

}
