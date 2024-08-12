<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutasPuntosRecogida extends Model{
    use HasFactory;

    //protected $connection = '';
    protected $table = 'rutas_puntos_recogida';

    public function punto_recogida()
    {
        return $this->belongsTo('App\Models\PuntoRecogida', 'punto_recogida_id');
    }

}