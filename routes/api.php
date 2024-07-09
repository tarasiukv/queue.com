<?php

use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::resource('users', UserController::class);

/**
 * USER
 * */
Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);

/**
 * EMAIL VERIFY
 */
Route::get('/verify/{user}', [EmailVerifyController::class, 'verify']);
