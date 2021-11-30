<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Models\User;

class AuthProcess
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

        # Check login - auto login for demostration purpose
        if(!Auth::check())    
        {
            $user = User::first();
            \Auth::login($user);
        }    
        return $next($request);
    }
}
