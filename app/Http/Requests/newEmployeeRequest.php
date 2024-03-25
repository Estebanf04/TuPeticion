<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newEmployeeRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    //---- Custom request para la creacion de un nuevo usuario/empleado en la seccion de EMPLEADOS que tienen los administradores
    
    public function rules(): array
    {
        return [
            'name' => 'string|required|max:30|alpha',
            'surname' => 'string|required|max:30|alpha',
            'email' => 'email|required',
            'password' => 'min:7',
            'dni' => 'min:1|max:10'
        ];
    }
}
