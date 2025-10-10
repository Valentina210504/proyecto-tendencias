<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruta extends Model
{
    Use HasFactory;
    protected $table = 'rutas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre_ruta',
        'descripcion',
        'distancia_en_km',
        'tiempo_estimado',
        'costo_peaje',
        'estado',
        'registrado_por',
    ];
    protected $guarded=['id',
        'created_at',
        'updated_at'   
    ];

    //relacion con viaje(uno a muchos)
    public function viaje()
    {
        return $this->hasMany(Viaje::class, 'ruta_id');
    }

}