<?php

namespace App\Providers;

use App\Events\PaymentCreatedEvent;
use App\Listeners\PaymentCreatedListener;
use App\Services\MailService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MailService::class, function ($app) {
            return new MailService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            PaymentCreatedEvent::class,
            [PaymentCreatedListener::class, 'handle']
        );
    }
}
