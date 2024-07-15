<?php

use App\Jobs\PaymentJob;
use App\Models\Payment;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
