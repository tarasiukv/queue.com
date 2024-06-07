<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function store(UserRequest $request)
    {
        $data = $request->validate();
        $user = User::create($data);

        $this->userService->dispatchEmailJob($user);

        return response()->json($user, 201);
    }
}
