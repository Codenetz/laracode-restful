<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        return null;
    }
}
