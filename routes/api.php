<?php

use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Jobs\EmailJob;
use App\Jobs\PaymentJob;
use App\Models\Payment;
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
Route::post('verify/{user}', [EmailVerifyController::class, 'verify']);

/**
 * PAY
 */
Route::get('pays', [PaymentController::class, 'index']);
Route::post('pays', [PaymentController::class, 'store']);

/**
 * SENDING EMAIL
 */
//Route::get('/send-email', function () {
//    $email = 'example@example.com';
//
//    dispatch(new EmailJob($email));
//
//    return 'Email is being sent!';
//});

Route::get('/test-payments', function () {
    // Створіть 1000 користувачів з оплатами
    $payments = Payment::factory()->count(500)->create();

    // Запустіть джоби для кожної оплати
    foreach ($payments as $payment) {
//        dd('payment', $payment);
        PaymentJob::dispatch($payment)->onQueue('payment');
    }

    return 'Test payments and jobs created and dispatched!';
});
