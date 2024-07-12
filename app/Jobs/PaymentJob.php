<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300;

    protected $payment;

    /**
     * Create a new job instance.
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->payment->load('user');
            $email = $this->payment->user->email;

            Log::info("Success payment sending to {$email}");

            //        Mail::to($this->user->email)->send(new UserMail($this->user));

        } catch (\Exception $e) {
            Log::error("Failed sending to {$this->user->email}: " . $e->getMessage());
        }
    }
}
