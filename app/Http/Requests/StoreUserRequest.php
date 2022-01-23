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
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'name'=>'required',
            'lastname'=>'required',
            'photo'=>'image',
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'Ingrese un email',
            'email.email'=>'Ingrese un email valido',
            'email.unique'=>'El email ya esta registrado',
            'password.required'=>'Ingrese una contraseña',
            'name.required'=>'Ingrese su nombre',
            'lastname.required'=>'Ingrese su apellido',
            'photo'=>'Formato invalido de imagen',
            // 'password.confirmed'=>'Confirme su contraseña',
        ];
    }
}
