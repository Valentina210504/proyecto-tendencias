<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RutaRequest extends FormRequest
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
        // Crear
        if ($this->isMethod('post')) {
            return [
                'nombre_ruta'      => 'required|string|max:255|unique:rutas,nombre_ruta',
                'descripcion'      => 'required|string|max:500',
                'distancia_en_km'  => 'required|numeric|min:0',
                'tiempo_estimado' => 'required|date_format:H:i:s',
                'costo_peaje'      => 'nullable|numeric|min:0',
                'precio'          => 'nullable|numeric|min:0',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'estado' => 'required|boolean'
            ];
        }

        // Actualizar
        // Actualizar
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // Intentar obtener el parámetro 'ruta' o cualquiera disponible en la ruta
            $ruta = $this->route('ruta');
            
            if (!$ruta && count($this->route()->parameters()) > 0) {
                $ruta = reset($this->route()->parameters());
            }

            $id = $ruta instanceof \App\Models\Ruta ? $ruta->id : $ruta;
            
            return [
                'nombre_ruta'      => 'required|string|max:255|unique:rutas,nombre_ruta,' . $id,
                'descripcion'      => 'required|string|max:500',
                'distancia_en_km'  => 'required|numeric|min:0',
                'tiempo_estimado'  => 'required', 
                'costo_peaje'      => 'nullable|numeric|min:0',
                'precio'          => 'nullable|numeric|min:0',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'registrado_por'   => 'sometimes|string|max:255',
                'estado'           => 'sometimes|boolean'
            ];
        }

        return [];
    }
}