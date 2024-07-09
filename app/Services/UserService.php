<?php

namespace App\Services;

use App\Jobs\EmailJob;
use App\Models\User;

class UserService
{
    public function dispatchEmailJob($user) {
        EmailJob::dispatch($user)->delay(now()->addMinutes(5));
    }

}
