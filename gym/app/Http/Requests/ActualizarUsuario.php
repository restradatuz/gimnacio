<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;


class ActualizarUsuario extends FormRequest
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
            "nombre"                =>  "required",
            "apellido"              =>  "required",
            "email"                 =>  "required|email",
            "tel"                   =>  "required|regex:/^[0-9]*$/i|min:10|max:10",
            "user_type"             =>  "required",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "nombre.required"                =>  "El campo es requerido",
            "apellido.required"              =>  "El campo es requerido",
            "email.required"                 =>  "El campo es requerido",
            "email.email"                    =>  "El :attribute no es válido",
            "email.unique"                   =>  "El email ya se encuentra en uso",
            "tel.required"                   =>  "El campo es requerido",
            "tel.regex"                      =>  "El teléfono de contacto debe contener solo dígitos",
            "tel.min"                        =>  "El teléfono de contacto debe contener al menos :min dígitos",
            "tel.max"                        =>  "El teléfono de contacto debe contener solo :max dígitos",
            "user_type.required"             =>  "El campo es requerido",
        ];
    }
}
