<?php

namespace App\Http\Requests\Vendedor;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string',
            'apellidos' => 'required|string',
            'dni'  => 'required|max:8|min:8|unique:users,dni',
            'email'  => 'required|email|unique:users,email',
            // 'estado' => 'string',
            'telefono'  => 'required|unique:users,telefono',
            'direccion' => 'required|string',
            'genero'  => 'required',
            'fechanacimiento' => 'required',
            'cargo_id' => 'required'
            // 'password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Este campo es obligatorio.',
            'name.string' => 'El valor ingresado no es válido.',

            'apellidos.required' => 'Este campo es obligatorio.',
            'apellidos.string' => 'El valor ingresado no es válido.',

            'dni.required' => 'Este campo es obligatorio.',
            'dni.max' =>  'Solo se aceptan 8 dígitos',
            'dni.min' => 'Se require 8 dígitos',
            'dni.unique' => 'El número de DNI, ya se encuentra registrado.',

            'email.required' => 'Este campo es obligatorio',
            'email.string' => 'El valor ingresado no es válido.',
            'email.email' => 'Ingrese una dirección de correo electrónico correcta.',
            'email.unique' => 'El correo electrónico ingresado, ya se encuentra en uso.',

            'telefono.required' => 'Este campo es obligatorio.',
            'telefono.unique' => 'El número de teléfono ingresado, ya está en uso.',

            'direccion.required' => 'Este campo es obligatorio.',
            'direccion.string' => 'El valor ingresado no es válido.',

            'genero.required' => 'Este campo es obligatorio.',

            'fechanacimiento.required' => 'Este campo es obligatorio.',

            'cargo_id.required' => 'Este campo es obligatorio.'
        ];
    }
}
