<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehiculo extends Model
{
    use HasFactory;
    protected $table = 'vehiculos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'marca_id',
        'tipo_vehiculo_id',
        'placa',
        'modelo',
        'año',
        'color',
        'kilometraje',
        'estado',
        'registrado_por'
    ];
    protected $guarded=[ 'id',
    'created_at',
    'updated_at'   
    ];

    //relacion con marca(muchos a uno)
    public function marcas()
    {
        return $this->belongsTo(Marca::class);
    }
    //relacion con tipo_vehiculo(muchos a uno)
    public function tipo_vehiculos()
    {
        return $this->belongsTo(Tipo_Vehiculo::class);   
    }
    
    //relacion con viaje(uno a muchos)
    public function viajes()
    {
        return $this->hasMany(Viaje::class, 'vehiculo_id');   
    }
    //relacion con recarga_combustible(uno a muchos)
    public function recarga_combustibles()
    {
        return $this->hasMany(Recarga_Combustible::class, 'vehiculo_id');   
    }
}