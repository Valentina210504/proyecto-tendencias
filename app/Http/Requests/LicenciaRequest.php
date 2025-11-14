<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenciaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación según el método (POST o PUT/PATCH)
     */
    public function rules(): array
    {
    //     if ($this->isMethod('post')) {
    //         return [
    //             'numero_licencia'   => 'required|string|max:50|unique:licencias,numero_licencia',
    //             'tipo_licencia'     => 'required|string|max:100',
    //             'fecha_expedicion'  => 'required|date',
    //             'fecha_vencimiento' => 'required|date|after:fecha_expedicion',
    //             'entidad_emisora'   => 'required|string|max:150',
    //             'estado'            => 'required|boolean',
    //             'registrado_por'    => 'nullable|string|max:255',
    //         ];
    //     } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
    //         $licenciaId = $this->route('licencia'); // obtiene el ID de la ruta

    //         return [
    //             'numero_licencia'   => 'required|string|max:50|unique:licencias,numero_licencia,' . $licenciaId,
    //             'tipo_licencia'     => 'required|string|max:100',
    //             'fecha_expedicion'  => 'required|date',
    //             'fecha_vencimiento' => 'required|date|after:fecha_expedicion',
    //             'entidad_emisora'   => 'required|string|max:150',
    //             'estado'            => 'required|boolean',
    //             'registrado_por'    => 'nullable|string|max:255',
    //         ];
    //     }

       
     }
}