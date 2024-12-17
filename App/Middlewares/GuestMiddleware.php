<?php

namespace App\Middlewares;

use function Core\auth;
use function Core\redirect;

class GuestMiddleware
{
    public function handle()
    {
        if (auth()) {
            return redirect('/contacts');
        }
    }
}
