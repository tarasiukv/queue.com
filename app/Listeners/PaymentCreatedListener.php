<?php

namespace App\Listeners;

use App\Events\PaymentCreatedEvent;
use App\Jobs\PaymentJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentCreatedEvent $event)
    {
        PaymentJob::dispatch($event->payment)->onQueue('payment');
    }
}
