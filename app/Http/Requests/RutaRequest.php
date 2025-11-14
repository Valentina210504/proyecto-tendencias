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
                'estado' => 'required|boolean'
            ];
        }

        // Actualizar
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rutaId = $this->route('ruta'); // ID que llega desde el parámetro de la ruta

            return [
                'nombre_ruta'      => 'required|string|max:255|unique:rutas,nombre_ruta,' . $rutaId,
                'descripcion'      => 'required|string|max:500',
                'distancia_en_km'  => 'required|numeric|min:0',
                'tiempo_estimado' => 'required|date_format:H:i:s',
                'costo_peaje'      => 'nullable|numeric|min:0',
                'estado' => 'required|boolean'
            ];
        }

        return [];
    }
}