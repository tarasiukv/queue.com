<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::resource('users', UserController::class);

/**
 * USER
 * */
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);

/**
 * PAY
 */
Route::get('pays', [PaymentController::class, 'index']);
Route::post('pays', [PaymentController::class, 'store']);
