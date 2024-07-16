<?php

namespace App\Jobs\Middleware;

use Illuminate\Support\Facades\Log;

class DelayMiddleware
{
    public function handle($job, $next)
    {
        sleep(10);
        $next($job);
    }
}
