<?php

namespace App\Middlewares;

use function Core\auth;
use function Core\redirect;

class AuthMiddleware
{
    public function handle()
    {
        if (! auth()) {
            return redirect('/login');
        }
    }
}
