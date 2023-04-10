<?php

namespace App\Http\Requests\Cargo;

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
            'descripcion' => 'required|unique:cargos,descripcioncargo',
            'sueldo' => 'required|numeric'
        ];
    }

    public function messages() {
        return [
            'descripcion.required' => 'Este campo es obligatorio',
            'descripcion.unique' => 'Ya existe un cargo creado bajo este nombre',

            'sueldo.required' => 'Este campo es obligatorio.',
            'sueldo.numeric' => 'Es te campo es numérico'
        ];
    }
}