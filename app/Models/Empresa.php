<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ Agregado
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory; // ✅ en minúscula "use", no "Use"

    protected $table = 'empresas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nit', 
        'nombre',
        'direccion',
        'telefono',
        'email',
        'estado',
        'registrado_por'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}