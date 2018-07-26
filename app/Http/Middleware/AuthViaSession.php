<?php

namespace App\Http\Middleware;

use Closure;

class AuthViaSession
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
        if($request->session()->get('status') != 'AUTHENTICATED'){
            return redirect('/login');
        }
        return $next($request);
    }
}
