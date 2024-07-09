<?php

namespace App\Http\Controllers;

use App\Jobs\UserJob;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }
    public function store()
    {
        $user = User::factory()->create();
        if (!$user) {
            return response()->json('User not created', 400);
        }

        UserJob::dispatch($user);

        $this->statusVerifyEmail($user);

        return response()->json($user, 201);
    }

    public function statusVerifyEmail(User $user)
    {
        $user->email_verified_at = now();
        $user->save();
    }
}
