<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreationRequest;
use App\Http\Requests\changePassword;
use Auth;
use App\Models\Peticion;
use App\Models\User;

class EmpleadoController extends Controller
{

    public function __construct()
    {
        $this->middleware('employee');  //---- Middleware para empleado
    }

    public function index(){
        return view ('empleado.empleadohome'); //---- Redireccion al home
    }


    //--------- Metodos para seccion de CREAR PETICION ------------//


    public function createRequest(){    //---- Carga la vista del formulario de creacion
        return view ('empleado.create');
    }


    public function saveRequest(CreationRequest $request){   //---- Insercion del nuevo registro creado validado por nuestra custom-request 
        $id = Auth::user()->id;
            Peticion::create([
                'user_id' => $id,
                'date' => $request->date,
                'content' => $request->content
            ]);
        return redirect()->route('employeehome')
        ->with(['message' => 'Peticion enviada con exito']);
    }


    //--------- Metodos para seccion de MIS PETICIONES ------------//


    public function myRequests(){   //---- Listar todas las peticiones hechas por el usuario identificado, con una paginacion de 5 por pagina
        $id = Auth::user()->id;
        $peticiones = Peticion::orderBy('created_at', 'DESC')
        ->where('user_id', $id)
        ->simplepaginate(5);
        return view('empleado.myrequests', compact('peticiones'));
    }


    public function seeMyRequest($id){   //---- Vista para ver los datos de la peticion especifica seleccionada
        $peticionespecifica = Peticion::find($id);
        return view('empleado.specific-request', compact('peticionespecifica'));
    }


    //--------- Metodos para seccion de MI PERFIL ------------//


    public function changePassword(){   //---- Cargar vista para cambiar la contraseña
        return view('admin.changepassword');
    }


    public function saveNewPassword(changePassword $request){      //---- Validamos el cambio de contraseña con una nueva custom-request, y hacemos el cambio y redireccion.
        $id = Auth::user()->id;
        $user = User::find($id);
        $contraseña = $request->password;
        $confirmacion = $request->confirmpassword;

        if($contraseña === $confirmacion){
            $user->password = $contraseña;
            $user->save();
            return redirect()->route('profileempleado')->with([
                'message' => 'Contraseña actualizada con exito'
            ]);
        }
        elseif($contraseña !== $confirmacion){
            return redirect()->route('changePasswordUser')->with([
                'message' => 'Las contraseñas no coinciden'
            ]);
        }
    }

}
