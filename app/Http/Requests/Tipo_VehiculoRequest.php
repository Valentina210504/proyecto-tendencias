<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Tipo_VehiculoRequest extends FormRequest
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
     */
    public function rules(): array
    {
        // CREATE
        if ($this->isMethod('post')) {

            return [
                'nombre' => 'required|string|max:255|unique:tipo_vehiculos,nombre',
                'descripcion' => 'nullable|string|max:500',
                'capacidad_pasajero' => 'required|integer|min:1|max:60',
                'capacidad_carga' => 'required|numeric|min:0|max:10000',
                'capacidad_gasolina' => 'required|numeric|min:0|max:200',
                'estado' => 'required|boolean',
            ];
        }

        // UPDATE
        if ($this->isMethod('put') || $this->isMethod('patch')) {

            // Obtiene el ID desde la ruta
            $tipoVehiculoId = $this->route('tipo_vehiculo');

            return [
                'nombre' => 'required|string|max:255|unique:tipo_vehiculos,nombre,' . $tipoVehiculoId,
                'descripcion' => 'nullable|string|max:500',
                'capacidad_pasajero' => 'required|integer|min:1|max:60',
                'capacidad_carga' => 'required|numeric|min:0|max:10000',
                'capacidad_gasolina' => 'required|numeric|min:0|max:200',
                'estado' => 'required|boolean',
            ];
        }

        return [];
    }
}