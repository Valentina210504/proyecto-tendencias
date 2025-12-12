<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Recarga_CombustibleRequest extends FormRequest
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
                'vehiculo_id' => 'required|exists:vehiculos,id',
                'cantidad_litros' => 'required|numeric|min:0',
                'precio_litro' => 'required|numeric|min:0',
                'costo_total' => 'required|numeric|min:0',
                'estacion_servicio' => 'required|string|max:255',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'estado' => 'required|boolean'
            ];
        } elseif (request()->isMethod('put') || request()->isMethod('patch')) {
            return [
                'vehiculo_id' => 'required|exists:vehiculos,id',
                'cantidad_litros' => 'required|numeric|min:0',
                'precio_litro' => 'required|numeric|min:0',
                'costo_total' => 'required|numeric|min:0',
                'estacion_servicio' => 'required|string|max:255',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'registrado_por' => 'sometimes|string|max:255',
                'estado' => 'sometimes|boolean'
            ];
        }
    }
}