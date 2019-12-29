<?php

namespace App\Modules\User\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

/**
 * Class Role
 * @package App\Modules\User\Middleware
 */
class Role
{
    /**
     * @param $request
     * @param Closure $next
     * @param null $role
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, $role = null)
    {
        $user = Auth::user();

        if ($user && in_array($role, Config::get('UserRoles')['LEVELS'][$user->role])) {
            return $next($request);
        }

        throw new AuthenticationException();
    }
}
