<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        if (\App\Role::isRole($role)) {
            return $next($request);
        }
        return abort(401, 'Maaf, anda tidak diizinkan mengakses halaman ini.');
    }
}
