<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotAdmin
{
    public function handle($request, Closure $next, $guard="admin")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('admin.login'));
        }
        return $next($request);
    }
}
