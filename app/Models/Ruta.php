<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    //protected $connection = '';
    protected $table = 'rutas';

    public function vehiculo()
    {
        return $this->belongsTo('App\Models\Vehiculos', 'vehiculo_id');
    }

    public function conductor()
    {
        return $this->belongsTo('App\Models\User', 'usuario_id');
    }

    public function getMatriculaVehiculoAttribute()
    {
        if ($this->vehiculo_id != null) {
            return $this->vehiculo->matricula;
        } else {
            return 'SIN MATRICULA';
        }
    }

    public function getNombreConductorAttribute()
    {
        if ($this->usuario_id != null) {
            return $this->conductor->name . ' ' . $this->conductor->surname;
        } else {
            return 'SIN CONDUCTOR';
        }
    }
}
