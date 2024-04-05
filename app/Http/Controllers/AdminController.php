<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Peticion;
use Auth;
use App\Http\Requests\newEmployeeRequest;
use App\Http\Requests\changePassword;
use App\Http\Services\AdminService;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');     
    }

    public function index(){
        return view ('admin.adminhome'); 
    }


    //--------- Metodos para seccion de PETICIONES PENDIENTES ------------//


    public function showRequest(AdminService $adminService){     
        $peticiones = $adminService->showPendingRequest();
        return view('admin.request', compact('peticiones'));
    }

    public function seeSpecificRequest($id){     
        $peticionespecifica = Peticion::find($id);
        return view('admin.specific-request', compact('peticionespecifica'));
    }

    public function acceptSpecificRequest($id, AdminService $adminService){  
        $adminService->acceptRequest($id);
        return redirect()->route('showRequest')->with(['message' => 'Peticion aceptada correctamente']);
    }

    public function denySpecificRequest($id, AdminService $adminService){  
        $adminService->denyRequest($id);
        return redirect()->route('showRequest')->with(['message' => 'Peticion denegada correctamente']);
    }

    //--------- Metodos para seccion de EMPLEADOS ------------//


    public function showEmployees(AdminService $adminService){   
        $empleados = $adminService->showAllEmployees();
        return view('admin.employees', compact('empleados'));
    }

    public function createEmployee(){   
        return view('admin.createemployee');
    }

    public function saveEmployee(newEmployeeRequest $request, AdminService $adminService){   
        $employee = $adminService->saveNewEmployee($request);
        return redirect()->route('showEmployees')->with(['message' => 'Empleado dado de alta exitosamente']);
    }

    public function editEmployee($id){    
        $employee = User::find($id);
        return view('admin.edit-employee',compact('employee'));
    }

    public function updateEmployee($id, newEmployeeRequest $request, AdminService $adminService){    
        $employee = $adminService->updateEmployee($id, $request);
        return redirect()->route('showEmployees')->with(['message' => 'Empleado actualizado exitosamente']);
    }

    public function deleteEmployee($id, AdminService $adminService){ 
        $employee = $adminService->deleteEmployee($id);
        return redirect()->route('showEmployees')->with(['message' => $employee->name.' '.$employee->surname.' fue eliminado exitosamente']);
    }

    //--------- Metodos para seccion de HISTORIAL ------------//


    public function showRequestHistory(AdminService $adminService){   
        $peticiones = $adminService->showRequestHistory();
        return view('admin.requesthistory', compact('peticiones'));
    }

    //--------- Metodos para seccion de MI PERFIL ------------//


    public function profile(){   
        return view('admin.profile');
    }

    public function changePassword(){   
        return view('admin.changepassword');
    }

    public function saveChangePassword(changePassword $request, AdminService $adminService){    
        
        $verify = $adminService->saveChangePassword($request);

        if($verify == true){
            return redirect()->route('profile')->with(['message' => 'Contraseña actualizada con exito']);
        }
        elseif($verify == false){
            return redirect()->route('changePassword')->with(['message' => 'Las contraseñas no coinciden']);
        }  
    }
}
