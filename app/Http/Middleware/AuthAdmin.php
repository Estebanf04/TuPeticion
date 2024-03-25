<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AuthAdmin
{
    
    //---- Creamos el middleware para el controlador de administrador. El usuario debe estar logueado y ademas que su rol sea 'admin', sino, lo redirige al login.

    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            if(auth()->user()->role == 'admin'){
                return $next($request);
            }
        }
        return redirect()->to('/login');
        
    }
}
