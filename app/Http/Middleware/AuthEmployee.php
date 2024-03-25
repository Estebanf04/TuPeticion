<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AuthEmployee
{

    //---- Creamos el middleware para el controlador de empleados. El usuario debe estar logueado y ademas que su rol sea 'user', sino, lo redirige al login.
    
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            if(auth()->user()->role == 'user'){
                return $next($request);
            }
        }
        return redirect()->to('/login');
        
    }
}
