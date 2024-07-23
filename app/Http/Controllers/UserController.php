<?php

namespace App\Http\Controllers;

use App\Events\UserRegisteredEvent;
use App\Http\Resources\UserResource;
use App\Jobs\UserRegisteredJob;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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

            $this->userService->statusVerifyEmail($user);

            if (!app('events')->hasListeners(UserRegisteredEvent::class)) {
                UserRegisteredEvent::dispatch();
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to create users: ' . $e->getMessage());
        }

        return response()->json(201);
    }

    public function search(Request $request)
    {
        try {
            $search_text = $request['search_text'];
            $email = $request['email'];
            $payments = $request['payments'];

            $users = User::search($search_text)
                ->filterByEmailVerified($email)
                ->filterByPayment($payments)
                ->with(['payments'])
                ->get();

            return response()->json(['data' => $users]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error while search'], 500);
        }
    }

}
