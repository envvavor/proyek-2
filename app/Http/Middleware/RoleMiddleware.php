<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $roles = [
            'admin' => 1,
            'guru' => 2,
            'murid' => 3,
        ];

        if (Auth::check() && Auth::user()->role == $roles[$role]) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}

