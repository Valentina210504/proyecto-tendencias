<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->isMethod('post')){
            return [
                'nombre' => 'required|string|max:255|unique:marcas,nombre',
                'pais_origen' => 'required|string|max:255',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'estado' => 'required|boolean'
            ];
        } elseif (request()->isMethod('put') || request()->isMethod('patch')) {
            // Intentar obtener el parámetro 'marca' o cualquiera disponible en la ruta
            $marca = $this->route('marca');
            
            if (!$marca && count($this->route()->parameters()) > 0) {
                $marca = reset($this->route()->parameters());
            }

            $id = $marca instanceof \App\Models\Marca ? $marca->id : $marca;

            return [
                'nombre' => 'required|string|max:255|unique:marcas,nombre,' . $id,
                'pais_origen' => 'required|string|max:255',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'registrado_por' => 'sometimes|string|max:255',
                'estado' => 'sometimes|boolean'
            ];
        }
    }
}