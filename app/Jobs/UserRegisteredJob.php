<?php

namespace App\Jobs;

use App\Mail\UserRegisteredMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserRegisteredJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function middleware()
    {
        return [new WithoutOverlapping];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
//            Mail::to($this->user->email)->send(new UserRegisteredMail($this->user));
            Mail::to('tarasiuk.viktor.m@gmail.com')->send(new UserRegisteredMail($this->user));
            Log::info("Success registration user: {$this->user->email}");
        } catch (\Exception $e) {
            Log::error("Failed sending to {$this->user->email}: " . $e->getMessage());
        }
    }
}
