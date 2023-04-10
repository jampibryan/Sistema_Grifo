<?php

namespace App\Http\Requests\Categoria;

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
            'descripcion' => 'required|string',
        ];
    }

    public function messages() {
        return [
            'descripcion.required' => 'Este campo es obligatorio.',
            'descripcion.string' => 'El valor ingresado no es válido.',
        ];
    }
}