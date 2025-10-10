<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Viaje extends Model
{
    Use HasFactory;
    protected $table = 'viajes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'vehiculo_id',
        'conductor_id',
        'ruta_id',
        'descripcion',
        'recorrido',
        'tiempo_estimado',
        'costo_total',
        'estado',
        'registrado_por'
    ];
    protected $guarded=['id',
        'created_at',
        'updated_at'   
    ];

    //relacion con vehiculo(muchos a uno)
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
    //relacion con ruta(muchos a uno)
    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }
    //relacion con conductor(muchos a uno)
    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }
}