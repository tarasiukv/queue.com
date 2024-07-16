<?php

namespace App\Jobs;

use App\Jobs\Middleware\DelayMiddleware;
use App\Mail\PaymentMail;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;

    /**
     * Create a new job instance.
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment->load('user');
    }

    /**
    * @return array
    */
    public function middleware()
    {
        return [
            new WithoutOverlapping($this->payment->id),
            new DelayMiddleware
            ];

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $email = $this->payment->user->email ?? null;

            Mail::to($email)->send(new PaymentMail($this->payment));
            // test
//            Mail::to('tarasiuk.viktor.m@gmail.com')->send(new PaymentMail($this->payment));

            Log::info("Success payment sending from {$email}");
        } catch (\Exception $e) {
            Log::error("Failed sending from {$email}. Payment model: {$this->payment}. " . $e->getMessage());
        }
    }
}
