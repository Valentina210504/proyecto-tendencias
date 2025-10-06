<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
 use HasFactory;
 protected $table = 'marcas';
 protected $primaryKey = 'id';
 protected $fillable = [
'nombre',
'pais_origen',
'estado',
'registrado_por'
];

protected $guarded=[ 'id',
'created_at',
'updated_at'   
];
//relacion con vehiculo(uno a muchos) 
public function vehiculos()
{
    return $this->hasMany(Vehiculo::class, 'marca_id');
}
}