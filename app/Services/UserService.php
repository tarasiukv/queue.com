<?php

namespace App\Services;

use App\Http\Controllers\EmailVerifyController;
use App\Jobs\EmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserService
{
    public $delay = 5;

    public function statusVerifyEmail(User $user)
    {
        $user->email_verified_at = now();
        $user->save();
    }

    public function notifyUserCreated()
    {

    }
}
