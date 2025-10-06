<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Recarga_Combustible extends Model
{
    Use HasFactory;
    protected $table = 'recarga_combustibles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cantidad_litros',
        'precio_litro',
        'costo_total',
        'estacion_servicio',
        'estado',
        'registrado_por'
    ];
    protected $guarded=['id',
        'created_at',
        'updated_at'   
    ];
    //relacion con vehiculo(muchos a uno)
    public function vehiculos()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}