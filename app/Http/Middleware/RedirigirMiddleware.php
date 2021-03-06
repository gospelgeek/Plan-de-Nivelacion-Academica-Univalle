<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;

class RedirigirMiddleware
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::check())
         {  
            
            if($this->auth->user()->rol_id == '1'){
               //dd('holaa');
               return Redirect::to('estudiante');                
            }

            if(($this->auth->user()->rol_id == '2') || ($this->auth->user()->rol_id == '3') || ($this->auth->user()->rol_id == '4') || ($this->auth->user()->rol_id == '5') || ($this->auth->user()->rol_id == '6')){
                return Redirect::to('estudiante');
                //dd('entrod');
            }
                                   
        }else{
            return redirect()->to('logout');
        }
    }
    
}
