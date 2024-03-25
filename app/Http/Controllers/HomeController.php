<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()     //---- Redireccion segun su rol
    {
        if(Auth::check() && Auth::user()->role == 'admin'){
        return redirect()->route('adminhome');
        }
        elseif(Auth::check() && Auth::user()->role == 'user'){
            return redirect()->route('employeehome');
        }
    }
}
