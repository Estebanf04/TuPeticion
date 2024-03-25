<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    //---- Custom request para el cambio de contraseña en la seccion de 'MI PERFIL'

    public function rules(): array
    {
        return [
            'password' => 'required|min:7|max:16',
            'confirmpassword' => 'required|min:7|max:16'
        ];
    }
}
