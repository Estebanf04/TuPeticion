<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreationRequest;
use App\Http\Requests\changePassword;
use Auth;
use App\Models\Peticion;
use App\Models\User;
use App\Http\Services\EmployeeService;

class EmpleadoController extends Controller
{

    public function __construct()
    {
        $this->middleware('employee'); 
    }

    public function index(){
        return view ('empleado.empleadohome'); 
    }

    //--------- Metodos para seccion de CREAR PETICION ------------//


    public function createRequest(){    
        return view ('empleado.create');
    }

    public function saveRequest(CreationRequest $request, EmployeeService $employeeService){ 
        $employeeService->newRequest($request);
        return redirect()->route('employeehome')->with(['message' => 'Peticion enviada con exito']);
    }

    //--------- Metodos para seccion de MIS PETICIONES ------------//


    public function myRequests(EmployeeService $employeeService){  
        $peticiones = $employeeService->showMyRequests();
        return view('empleado.myrequests', compact('peticiones'));
    }

    public function seeMyRequest($id){   
        $peticionespecifica = Peticion::find($id);
        return view('empleado.specific-request', compact('peticionespecifica'));
    }

    //--------- Metodos para seccion de MI PERFIL ------------//


    public function changePassword(){   
        return view('admin.changepassword');
    }

    public function saveNewPassword(ChangePassword $request, EmployeeService $employeeService){    
        
        $verify = $employeeService->saveNewPassword($request);

        if($verify == true){
            return redirect()->route('profileempleado')->with(['message' => 'Contraseña actualizada con exito']);
        }
        elseif($verify == false){
            return redirect()->route('changePasswordUser')->with(['message' => 'Las contraseñas no coinciden']);
        }  
    }

}
