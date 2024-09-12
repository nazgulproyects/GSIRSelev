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
        'proveedor_id',  
        'fecha_retirada', 
        'proveedor',
        'cif',
        'email',
        'poblacion',
        'provincia_pais',
        'trabajador',
        'tipo',
        'grupo',
        'bidones',
        'garrafas',
        'litros',
        'kilos',
        'total_kilos',
        'residuo',
        'importe',
        'forma_pago',
        'suministro',
        'deposito',
    ];
}
