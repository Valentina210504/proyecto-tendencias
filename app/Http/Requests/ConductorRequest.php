<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConductorRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'documento' => 'required|string|max:20|unique:conductores,documento',
                'fecha_contrato' => 'nullable|date',
                'estado' => 'required|in:activo,inactivo',
                'registrado_por' => 'required|string|max:255',

            ];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {     
            $conductor = $this->route('conductor') ?? $this->route('conductore');
            
            if (!$conductor && count($this->route()->parameters()) > 0) {
                $conductor = reset($this->route()->parameters());
            }

            $id = $conductor instanceof \App\Models\Conductor ? $conductor->id : $conductor;

            return [
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'documento' => 'required|string|max:20|unique:conductores,documento,' . $id,
                'fecha_contrato' => 'nullable|date',
                'registrado_por' => 'sometimes|string|max:255', 
            ];
        }
    }


    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del conductor es obligatorio.',
            'apellido.required' => 'El apellido del conductor es obligatorio.',
            'documento.required' => 'El documento del conductor es obligatorio.',
            'documento.unique' => 'Ya existe un conductor con este número de documento.',
            'fecha_contrato.date' => 'La fecha de contrato debe ser una fecha válida.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser "activo" o "inactivo".',
            'registrado_por.required' => 'El campo "registrado por" es obligatorio.',
        ];
    }
}