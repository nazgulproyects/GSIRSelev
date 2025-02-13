<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoRecogida extends Model
{
    use HasFactory;

    //protected $connection = '';
    protected $table = 'puntos_recogida';

    /**
     * Los atributos que se pueden asignar de manera masiva.
     *
     * @var array
     */
    protected $fillable = [
        'no_prov_cli',
        'ruta_id',
        'estado'
        // Otros campos que quieras habilitar para asignación masiva
    ];
}
