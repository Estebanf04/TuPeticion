<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Peticion;
use Auth;
use App\Http\Requests\newEmployeeRequest;
use App\Http\Requests\changePassword;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('admin');     //---- Middleware para administrador
    }


    public function index(){
        return view ('admin.adminhome'); //---- Redireccion al home
    }


    //--------- Metodos para seccion de PETICIONES PENDIENTES ------------//


    public function showRequest(){     //---- Listar peticiones por fecha ascendente y con una paginacion de 5 por pagina.
        $peticiones = Peticion::orderBy('date', 'ASC')
        ->where('status', 'pendiente')
        ->simplepaginate(5);
        return view('admin.request', compact('peticiones'));
    }


    public function seeSpecificRequest($id){     //---- Ver una peticion especifica
        $peticionespecifica = Peticion::find($id);
        return view('admin.specific-request', compact('peticionespecifica'));
    }


    public function acceptSpecificRequest($id){  //---- Aceptar una peticion
        $peticion = Peticion::find($id);
        $peticion->update([
            'status' => 'aceptada'
        ]);
        $peticion->save();
        return redirect()->route('showRequest')
        ->with(['message' => 'Peticion aceptada correctamente']);
    }


    public function deleteSpecificRequest($id){  //---- Denegar una peticion
        $peticion = Peticion::find($id);
        $peticion->update([
            'status' => 'denegada'
        ]);
        return redirect()->route('showRequest')
        ->with(['message' => 'Peticion denegada correctamente']);
    }


    //--------- Metodos para seccion de EMPLEADOS ------------//

    
    public function showEmployees(){   //---- Listar empleados por orden de creacion descendente y con una paginacion de 7 por pagina.
        $empleados = User::orderBy('created_at', 'desc')
        ->where('role', 'user')
        ->where('admin_id', Auth::user()->id)
        ->simplepaginate(7);
        return view('admin.employees', compact('empleados'));
    }


    public function createEmployee(){   //---- Cargar vista de formulario de creacion de empleado
        return view('admin.createemployee');
    }


    public function saveEmployee(newEmployeeRequest $request){   //---- Inserción del nuevo registro, validandolo con la custom-request hecha especificamente para esto.
        User::create([
            'admin_id' => Auth::user()->id,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => $request->password,
            'dni' => $request->password
        ]);
        return redirect()->route('showEmployees')->with(['message' => 'Empleado dado de alta exitosamente']);
    }


    public function editEmployee($id){    //---- Cargar la vista del formulario de edicion, enviandole los datos del empleado que se ha seleccionado para editar.
        $employee = User::find($id);
        return view('admin.edit-employee',compact('employee'));
    }


    public function updateEmployee(newEmployeeRequest $request, $id){    //---- Realizamos el update/edicion del registro, reutilizamos la misma custom request que en el metodo de creacion
        $employee = User::find($id);
        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->email = $request->email;
        $employee->password = $request->password;
        $employee->dni = $request->password;
        $employee->save();
        return redirect()->route('showEmployees')
        ->with(['message' => 'Empleado actualizado exitosamente']);
    }


    public function deleteEmployee($id){    //---- Eliminar empleado
        $employee = User::find($id);
        $employee->delete();
        return redirect()->route('showEmployees')
        ->with(['message' => $employee->name.' '.$employee->surname.' fue eliminado exitosamente']);
    }


    //--------- Metodos para seccion de HISTORIAL ------------//


    public function showRequestHistory(){   // Carga la vista del historial y se le envian las peticiones que ya hayan tenido una resolucion ('Aceptada' o 'Denegada'), con paginacion de 5 por pagina
        $peticiones = Peticion::orderBy('updated_at', 'DESC')
        ->where('status', 'aceptada')
        ->orWhere('status', 'denegada')
        ->simplepaginate(5);
        return view('admin.requesthistory', compact('peticiones'));
    }


    //--------- Metodos para seccion de MI PERFIL ------------//


    public function profile(){   //---- Carga la vista del perfil
        return view('admin.profile');
    }

    public function changePassword(){   //---- Carga la vista del formulario para cambiar la contraseña
        return view('admin.changepassword');
    }

    public function saveChangePassword(changePassword $request){    //---- Validamos el cambio de contraseña con una nueva custom-request, y hacemos el cambio y redireccion.
        $id = Auth::user()->id;
        $admin = User::find($id);
        $contraseña = $request->password;
        $confirmacion = $request->confirmpassword;

        if($contraseña === $confirmacion){
            $admin->password = $contraseña;
            $admin->save();
            return redirect()->route('profile')->with([
                'message' => 'Contraseña actualizada con exito'
            ]);
        }
        elseif($contraseña !== $confirmacion){
            return redirect()->route('changePassword')->with([
                'message' => 'Las contraseñas no coinciden'
            ]);
        }
        
    }
}
