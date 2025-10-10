<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contrato extends Model
{
    Use HasFactory;
    protected $table = 'contratos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fecha_inicio',
        'fecha_final',
        'salario',
        'estado',
        'registrado_por'
    ];

    protected $guarded=['id',
        'created_at',
        'updated_at'   
    ];
    //relacion con Conductor_Contrato(uno a muchos)
    public function conductor_contrato()
    {
        return $this->hasMany(Conductor_Contrato::class, 'contrato_id');
    }
}