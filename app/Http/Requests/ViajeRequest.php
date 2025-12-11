<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ViajeRequest extends FormRequest
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

        if ($this->isMethod('post')) {
            return [
                'vehiculo_id' => 'required|exists:vehiculos,id',
                'conductor_id' => 'required|exists:conductores,id',
                'ruta_id' => 'required|exists:rutas,id',
                'descripcion' => 'nullable|string|max:500',
                'recorrido' => 'required|numeric|min:0',
                'tiempo_estimado' => 'required|date_format:H:i:s',
                'costo_total' => 'required|numeric|min:0',
                'estado' => 'required|boolean',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {

            
            $viaje = $this->route('viaje');
            
            if (!$viaje && count($this->route()->parameters()) > 0) {
                $viaje = reset($this->route()->parameters());
            }

            return [
                'vehiculo_id'    => 'required|exists:vehiculos,id',
                'conductor_id'   => 'required|exists:conductores,id',
                'ruta_id'        => 'required|exists:rutas,id',
                'descripcion'    => 'nullable|string|max:500',
                'recorrido'      => 'required|numeric|min:0',
                'tiempo_estimado' => 'required', 
                'costo_total'    => 'required|numeric|min:0',
                'registrado_por' => 'sometimes|string|max:255',
                'estado'         => 'sometimes|boolean',
            ];
        }
    }
}