<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costes extends Model{
    use HasFactory;

    //protected $connection = '';
    protected $table = 'costes';

    public function entidad_vehiculo()
    {
        return $this->belongsTo('App\Models\Vehiculos', 'entidad_id');
    }

    public function entidad_cliente()
    {
        return $this->belongsTo('App\Models\CliProv', 'entidad_id');
    }
}