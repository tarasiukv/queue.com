<?php

namespace App\Jobs;

use App\Events\EmailSentEvent;
use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailJob implements ShouldQueue
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
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            //        Mail::to($this->user->email)->send(new UserMail($this->user));
            Log::info("Success sending to {$this->user->email}");
            var_dump($this->user->email);
        } catch (\Exception $e) {
            Log::error("Failed sending to {$this->user->email}: " . $e->getMessage());
        }
    }
}
