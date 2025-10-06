<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Licencia extends Model
{
    Use HasFactory;
    protected $table = 'licencias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'numero_licencia',
        'tipo_licencia',
        'fecha_expedicion',
        'fecha_vencimiento',
        'entidad_emisora',
        'estado',
        'registrado_por',
    ];
    protected $guarded=['id',
        'created_at',
        'updated_at'   
    ];
    //relacion con Conductor_Licencia(uno a muchos)
    public function conductores_licencias()
    {
        return $this->hasMany(Conductor_Licencia::class, 'licencia_id');
    }
}