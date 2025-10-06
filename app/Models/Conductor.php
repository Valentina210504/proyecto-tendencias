<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Conductor extends Model
{
    Use HasFactory;
    protected $table = 'conductores';
    protected $primaryKey = 'id';
    protected $fillable = ['id',
        'nombre',
        'apellido',
        'documento',
        'fecha_nacimiento',
        'estado',
        'registrado_por',
    ];
    protected $guarded=['id',
        'created_at',
        'updated_at'   
    ];

    //relacion con viaje(uno a muchos)
    public function viajes()
    {
        return $this->hasMany(Viaje::class, 'conductor_id');
    }
    //relacion con Conductor_Contrato(uno a muchos)
    public function conductores_contratos()
    {
        return $this->hasMany(Conductor_Contrato::class, 'conductor_id');
    }

    //relacion con  public function conductoresLicencias()
        public function conductores_licencias()
    {
        return $this->hasMany(Conductor_Licencia::class, 'conductor_id');
    }
}