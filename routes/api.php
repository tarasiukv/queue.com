<?php

use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::resource('users', UserController::class);

/**
 * USER
 * */
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);

/**
 * EMAIL VERIFY
 */
Route::get('/verify/{user}', [EmailVerifyController::class, 'verify']);
