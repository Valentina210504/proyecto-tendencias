<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conductor_Licencia extends Model
{
    Use HasFactory;
    protected $table = 'conductores_licencias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'conductor_id',
        'licencia_id',
        'fecha_asignacion',
        'estado_asignacion'
    ];

    protected $guarded=['id',
        'created_at',
        'updated_at'   
    ];
    
    //relacion con Conductor(Muchos a uno)
    public function conductor() {
        return $this->belongsTo(Conductor::class);
    }
    //relacion con Licencia(Muchos a uno)
    public function licencia() {
        return $this->belongsTo(Licencia::class);
    }
}