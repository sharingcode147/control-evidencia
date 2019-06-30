<?php

namespace App\Http\Middleware;

use Closure;

class authConsultas
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
        //  Redirección para usuarios que no son REVISOR o DAC.
        if(auth()->check()){
            //  Redirección según tipo de usuario.
            if (auth()->user()->hasRole('profesor')) {
                return redirect('/profesor/home');
            }
            if(auth()->user()->hasRole('admin'))
            {
                return redirect('/admin/home');
            }
        }
        else{
            // Usuario sin sesión.
            return redirect('/login');
        }
        return $next($request);
    }
}
