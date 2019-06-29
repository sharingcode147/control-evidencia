<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(auth()->check()){
            //  Redirección según tipo de usuario.
            if (auth()->user()->hasRole('profesor')) {
                return redirect('/profesor/home');
            }
            if(auth()->user()->hasRole('revisor'))
            {
                return redirect('/revisor/home');
            }
            if(auth()->user()->hasRole('dac'))
            {
                return redirect('/dac/home');
            }
            if (auth()->user()->hasRole('admin')) {
                return redirect('/admin/home');
            }
        }

        return $next($request);
    }
}
