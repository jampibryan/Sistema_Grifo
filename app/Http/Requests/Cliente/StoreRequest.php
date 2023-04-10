<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string',
            'nroDocumento' => 'required|unique:clientes,nroDocumento',
            'telefono' => 'string|max:9|min:9|unique:clientes,telefono',
            'email' => 'string|email|unique:clientes,email',
            'direccion' => 'required',
            'tipoCliente' => 'required'
        ];
    }

    public function messages() {
        return [
            'nombre.required' => 'Este campo es obligatorio.',
            'nombre.string' => 'El valor ingresado no es válido.',

            'nroDocumento.required' => 'Este campo es obligatorio.',            
            'nroDocumento.unique' => 'El número de documento ingresado ya se encuentra en uso.',

            'telefono.string' => 'El valor ingresado no es válido.',
            'telefono.max' => 'Se necesitan 9 caracteres.',
            'telefono.min' => 'Solo se aceptan 9 caracteres.',
            'telefono.unique' => 'El número de teléfono ingresado, ya está en uso.',

            'email.string' => 'El valor ingresado no es válido.',
            'email.email' => 'Ingrese una dirección de correo electrónico correcta.',
            'email.unique' => 'El correo electrónico ingresado, ya se encuentra en uso.',

            'direccion.required' => 'Este campo es obligatorio.',
            'tipoCliente.required' => 'Este campo es obligatorio.'
        ];
    }
}