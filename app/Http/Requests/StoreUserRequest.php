<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
        ];
    }


    public function messages()
    {
        return [
            'name.required'=>'Ingrese un nombre de usuario',
            'name.unique'=>'El nombre de usuario ya existe',
            'email.required'=>'Ingrese un email',
            'email.email'=>'Ingrese un email valido',
            'email.unique'=>'El email ya esta registrado',
            'password.required'=>'Ingrese una contraseña',
            'password.confirmed'=>'Confirme su contraseña',
        ];
    }
}
