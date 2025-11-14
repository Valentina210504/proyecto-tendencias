<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenciaRequest extends FormRequest
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
        if (request()->isMethod('post')) {

            return [
                'numero_licencia'     => 'required|string|max:255|unique:licencias,numero_licencia',
                'tipo_licencia'       => 'required|string|in:A1,A2,B1,B2,C1,C2',
                'fecha_expedicion'    => 'required|date',
                'fecha_vencimiento'   => 'required|date|after:fecha_expedicion',
                'entidad_emisora'     => 'required|string|max:255',
                'estado' => 'required|boolean'
            ];

        } elseif (request()->isMethod('put') || request()->isMethod('patch')) {

            $licenciaId = $this->route('licencia');

            return [
                'numero_licencia'     => 'required|string|max:255|unique:licencias,numero_licencia,' . $licenciaId,
                'tipo_licencia'       => 'required|string|in:A1,A2,B1,B2,C1,C2',
                'fecha_expedicion'    => 'required|date',
                'fecha_vencimiento'   => 'required|date|after:fecha_expedicion',
                'entidad_emisora'     => 'required|string|max:255',
                'estado' => 'required|boolean'
            ];
        }
    }
}