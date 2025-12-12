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
       
        if ($this->isMethod('post')) {

            return [
                'nombre' => 'required|string|max:255|unique:tipo_vehiculos,nombre',
                'descripcion' => 'nullable|string|max:500',
                'capacidad_pasajero' => 'required|integer|min:1|max:60',
                'capacidad_carga' => 'required|numeric|min:0|max:10000',
                'capacidad_gasolina' => 'required|numeric|min:0|max:200',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'estado' => 'required|boolean',
            ];
        }

       
        if ($this->isMethod('put') || $this->isMethod('patch')) {

            
            $tipo_vehiculo = $this->route('tipo_vehiculo');
            
            if (!$tipo_vehiculo && count($this->route()->parameters()) > 0) {
                $tipo_vehiculo = reset($this->route()->parameters());
            }

            $id = $tipo_vehiculo instanceof \App\Models\Tipo_Vehiculo ? $tipo_vehiculo->id : $tipo_vehiculo;

            return [
                'nombre' => 'required|string|max:255|unique:tipo_vehiculos,nombre,' . $id,
                'descripcion' => 'nullable|string|max:500',
                'capacidad_pasajero' => 'required|integer|min:1|max:60',
                'capacidad_carga' => 'required|numeric|min:0|max:10000',
                'capacidad_gasolina' => 'required|numeric|min:0|max:200',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'registrado_por' => 'sometimes|string|max:255',
                'estado' => 'sometimes|boolean',
            ];
        }

        return [];
    }
}