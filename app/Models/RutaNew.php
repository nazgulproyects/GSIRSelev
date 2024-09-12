<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutaNew extends Model
{
    use HasFactory;

    //protected $connection = '';
    protected $table = 'rutas_new';

    protected $fillable = [
        'proveedor_id',  // Agrega este campo
        // Otros campos que necesites asignar masivamente
    ];
}
