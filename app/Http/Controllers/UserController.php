<?php

namespace App\Http\Controllers;

use App\Events\UserRegisteredEvent;
use App\Http\Resources\UserResource;
use App\Jobs\UserRegisteredJob;
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
        $per_page = 100;

        try {
            $model = User::with([
                'payments',
            ])->paginate($per_page);

            return UserResource::collection($model);

        } catch (\Exception $e) {
            Log::error('Failed to retrieve users: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve users'], 500);

        }
    }

    public function store()
    {
        try {
            DB::beginTransaction();

            $user = User::factory()->create();
            Log::info("User created successfully: {$user->email}");

            UserRegisteredJob::dispatch($user)->onQueue('registration');
            $this->userService->statusVerifyEmail($user);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to create users: ' . $e->getMessage());
        }

        return response()->json(201);
    }

}
