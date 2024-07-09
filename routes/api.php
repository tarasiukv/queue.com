<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::resource('users', UserController::class);

/**
 * USER
 * */
Route::middleware('throttle:60,1')->group(function () {
    Route::post('/users', [UserController::class, 'store']);
});
Route::get('users', [UserController::class, 'index']);
