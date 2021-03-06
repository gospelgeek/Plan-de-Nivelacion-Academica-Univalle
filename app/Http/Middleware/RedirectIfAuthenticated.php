<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->rol_id == '1'){
                return redirect('usuario/');
            }

            if((Auth::user()->rol_id == '2') || (Auth::user()->rol_id == '3') || (Auth::user()->rol_id == '4') || (Auth::user()->rol_id == '5') || (Auth::user()->rol_id == '6')){
                return redirect('estudiante');
            }

        }

        return $next($request);   
    }
}
