<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreationRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    //---- Custom request para la creacion de una peticion en la seccion de 'CREAR PETICION' de los empleados
   
    public function rules(): array
    {
        return [
            'date' => 'date|required',
            'content' => 'required|min:5'
        ];
    }
}
