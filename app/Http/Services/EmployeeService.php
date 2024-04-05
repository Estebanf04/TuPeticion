<?php

namespace App\Http\Services;

use App\Models\User;
use Auth;
use App\Models\Peticion;
use App\Http\Requests\CreationRequest;
use App\Http\Requests\ChangePassword;


class EmployeeService
{
    public function newRequest(CreationRequest $request){
        Peticion::create([
            'user_id' => Auth::user()->id,
            'date' => $request->date,
            'content' => $request->content
        ]);
    }

    public function showMyRequests(){
        $peticiones = Peticion::orderBy('created_at', 'DESC')
        ->where('user_id', Auth::user()->id)
        ->simplepaginate(5);
        return $peticiones;
    }

    public function saveNewPassword(ChangePassword $request){
        
        $admin = User::find(Auth::user()->id);
        $contraseña = $request->password;
        $confirmacion = $request->confirmpassword;

        if($contraseña === $confirmacion){
            $admin->password = $contraseña;
            $admin->save();
            $verify = true; 
        }
        elseif($contraseña !== $confirmacion){
            $verify = false; 
        } 

        return $verify;
    }
}




?>



