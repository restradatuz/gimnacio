<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class NuevoUsuario extends FormRequest
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
            "email"                 =>  "required|unique:users|email",
            "tel"                   =>  "required|regex:/^[0-9]*$/i|min:10|max:10",
            "password"              =>  "required|min:6",
            "confirmar_password"    =>  "required|same:password|min:6",
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
            "email.unique"                   =>  "El :attribute ya se encuentra en uso",
            "email.email"                    =>  "El :attribute no es válido",
            "tel.required"                   =>  "El campo es requerido",
            "tel.regex"                      =>  "El teléfono de contacto debe contener solo dígitos",
            "tel.min"                        =>  "El teléfono de contacto debe contener al menos :min dígitos",
            "tel.max"                        =>  "El teléfono de contacto debe contener solo :max dígitos",
            "password.required"              =>  "El campo es requerido",
            "password.min"                   =>  "El :attribute debe contener al menos :min caracteres",
            "confirmar_password.required"    =>  "El campo es requerido",
            "confirmar_password.same"        =>  "El campo :attribute y :other no coinciden",
            "confirmar_password.min"         =>  "El campo :attribute  debe contener al menos :min caracteres",
            "user_type.required"             =>  "El campo es requerido",
        ];
    }
}
