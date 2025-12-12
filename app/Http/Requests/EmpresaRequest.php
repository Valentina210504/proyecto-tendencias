<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
        if(request()->isMethod('post')){
            return [
                'nit' => 'required|string|max:255|unique:empresas,nit', 
                'nombre' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
                'telefono' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'estado' => 'required|boolean'
            ];
        } elseif (request()->isMethod('put') || request()->isMethod('patch')) {
            
            $empresa = $this->route('empresa');
            
            if (!$empresa && count($this->route()->parameters()) > 0) {
                $empresa = reset($this->route()->parameters());
            }

            $id = $empresa instanceof \App\Models\Empresa ? $empresa->id : $empresa;

            return [
                'nit' => 'required|string|max:255|unique:empresas,nit,' . $id,
                'nombre' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
                'telefono' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'registrado_por' => 'sometimes|string|max:255',
                
                'estado' => 'sometimes|boolean' 
            ];
        }
    }
}