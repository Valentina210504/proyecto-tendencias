<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for store & update
     */
    public function rules(): array
    {
        // Crear (POST)
        if ($this->isMethod('post')) {
            return [
                'marca_id'          => 'required|exists:marcas,id',
                'tipo_vehiculo_id'  => 'required|exists:tipo_vehiculos,id',
                'placa'             => 'required|string|max:10|unique:vehiculos,placa',
                'modelo'            => 'required|string|max:255',
                'año'               => 'required|integer|min:1900|max:' . date('Y'),
                'color'             => 'required|string|max:255',
                'kilometraje'       => 'nullable|numeric|min:0',
                'estado' => 'required|boolean'
            ];
        }

       
        if ($this->isMethod('put') || $this->isMethod('patch')) {

           
            $vehiculo = $this->route('vehiculo');
            
            if (!$vehiculo && count($this->route()->parameters()) > 0) {
                $vehiculo = reset($this->route()->parameters());
            }

            $id = $vehiculo instanceof \App\Models\Vehiculo ? $vehiculo->id : $vehiculo;

            return [
                'marca_id'          => 'required|exists:marcas,id',
                'tipo_vehiculo_id'  => 'required|exists:tipo_vehiculos,id',
                'placa'             => 'required|string|max:10|unique:vehiculos,placa,' . $id,
                'modelo'            => 'required|string|max:255',
                'año'               => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'color'             => 'required|string|max:255',
                'kilometraje'       => 'nullable|numeric|min:0',
                'imagen'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'registrado_por'    => 'sometimes|string|max:255',
                'estado'            => 'sometimes|boolean'
            ];
        }

        return [];
    }
}