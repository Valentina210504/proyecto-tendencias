<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'fecha_inicio' => 'required|date',
                'fecha_final' => 'nullable|date|after_or_equal:fecha_inicio',
                'salario' => 'required|numeric|min:0',
                'estado' => 'required|in:activo,inactivo',
            ];
        } elseif (request()->isMethod('put') || request()->isMethod('patch')) {
            return [
                'fecha_inicio' => 'required|date',
                'fecha_final' => 'nullable|date|after_or_equal:fecha_inicio',
                'salario' => 'required|numeric|min:0',
                'registrado_por' => 'sometimes|string|max:255',
                
            ];
        }
    }
}