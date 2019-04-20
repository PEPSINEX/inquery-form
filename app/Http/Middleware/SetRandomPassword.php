<?php

namespace App\Http\Middleware;

use Closure;

class SetRandomPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request['password'] = str_random(10);
        $request['password_confirmation'] = $request['password'];

        return $next($request);
    }
}
