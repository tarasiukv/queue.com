<?php

namespace App\Http\Controllers;

use App\Events\NotifyUserCreatedEvent;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return User::all();

        } catch (\Exception $e) {
            dd('1111111111', $e);
        }
    }

    public function store()
    {
        try {
            DB::beginTransaction();
            $user = User::factory()->create();
            Log::info("User created successfully: {$user->email}");

            $this->userService->dispatchEmailJob($user);
            if (!app('events')->hasListeners(NotifyUserCreatedEvent::class)) {
                NotifyUserCreatedEvent::dispatch($user);
            }

            $this->userService->statusVerifyEmail($user);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to create users: ' . $e->getMessage());
        }

        return response()->json(201);
    }

}
