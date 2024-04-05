<?php

namespace App\Http\Services;

use App\Http\Requests\newEmployeeRequest;
use App\Http\Requests\Changepassword;
use App\Models\User;
use Auth;
use App\Models\Peticion;




class AdminService
{

    public function saveNewEmployee(newEmployeeRequest $request)
    {
        $employee = User::create([
            'admin_id' => Auth::user()->id,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => $request->password,
            'dni' => $request->password
        ]);
        return $employee;
    }

    public function showPendingRequest()
    {
        $peticiones = Peticion::orderBy('date', 'ASC')
        ->where('status', 'pendiente')
        ->simplepaginate(5);
        return $peticiones;
    }

    public function acceptRequest($id){
        $peticion = Peticion::find($id);
        $peticion->update(['status' => 'aceptada']);
        $peticion->save();
    }

    public function denyRequest($id){
        $peticion = Peticion::find($id);
        $peticion->update(['status' => 'denegada']);
        $peticion->save();
    }


    public function showAllEmployees(){
        $empleados = User::orderBy('created_at', 'desc')
        ->where('role', 'user')
        ->where('admin_id', Auth::user()->id)
        ->simplepaginate(7);
        return $empleados;
    }


    public function updateEmployee($id, newEmployeeRequest $request){
        $employee = User::find($id);
        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->email = $request->email;
        $employee->password = $request->password;
        $employee->dni = $request->password;
        $employee->save();
        return $employee;
    }


    public function deleteEmployee($id){
        $employee = User::find($id);
        $employee->delete();
        return $employee;
    }


    public function showRequestHistory(){
        $peticiones = Peticion::orderBy('updated_at', 'DESC')
        ->where('status', 'aceptada')
        ->orWhere('status', 'denegada')
        ->simplepaginate(5);
        return $peticiones;
    }


    public function saveChangePassword(ChangePassword $request){
        
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