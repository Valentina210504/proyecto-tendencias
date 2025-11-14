<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Recarga_CombustibleRequest extends FormRequest
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
                'cantidad_litros' => 'required|string|max:255',
                'precio_litro' => 'required|string|max:255',
                'costo_total' => 'required|string|max:255',
                'estacion_servicio' => 'required|string|max:255',
                'estado' => 'required|boolean'
            ];
        }elseif(request()->isMethod('put') || request()->isMethod('patch')){
            $marcaId = $this->route('recarga_combustible');
            return [
                'cantidad_litros' => 'required|string|max:255',
                'precio_litro' => 'required|string|max:255',
                'costo_total' => 'required|string|max:255',
                'estacion_servicio' => 'required|string|max:255',
                'estado' => 'required|boolean'
            ];
        }
    }
}