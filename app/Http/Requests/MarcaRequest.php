<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
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
                'nombre' => 'required|string|max:255|unique:marcas,nombre',
                'pais_origen' => 'required|string|max:255',
                'estado' => 'required|boolean'
            ];
        }elseif(request()->isMethod('put') || request()->isMethod('patch')){
            $marcaId = $this->route('marca');
            return [
                'nombre' => 'required|string|max:255|unique:marcas,nombre,' . $marcaId,
                'pais_origen' => 'required|string|max:255',
                'estado' => 'required|boolean'
            ];
        }
    }
}