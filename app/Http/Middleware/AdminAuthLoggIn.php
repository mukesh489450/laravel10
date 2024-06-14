<?php

namespace App\Http\Middleware;


use Closure;
use Session;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AdminAuthLoggIn{
    public function handle($request, Closure $next){
        
        if(FacadesAuth::guard('web')->user())
        {
            return $next($request);
        }
        else
        {
        	return redirect()->route('login');
        }
    }
}
