<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailVerifyController extends Controller
{
    public function verify(User $user)
    {
        if (!User::find($user->id))
        {
            Log::info("Verify failed: {$user->email}");
            return;
        }

        $user->email_verified_at = now();
        $user->save();

        Log::info("Email verify successfully: {$user->email}");
    }
}
