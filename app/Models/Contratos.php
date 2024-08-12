<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratos extends Model{
    use HasFactory;

    //protected $connection = '';
    protected $table = 'contratos';

    public function cli_prov()
    {
        return $this->belongsTo('App\Models\CliProv', 'cli_prov_id');
    }

    public function punto_recogida()
    {
        return $this->belongsTo('App\Models\PuntoRecogida', 'punto_recogida_id');
    }

    public function getNombreCliProvAttribute()
    {
        if ($this->cli_prov_id != null) {
            return $this->cli_prov->nombre;
        } else {
            return 'SIN CLIENTE/PROVEEDOR';
        }
    }

    public function getNombrePRAttribute()
    {
        if ($this->punto_recogida_id != null) {
            return $this->punto_recogida->nombre;
        } else {
            return 'SIN PUNTO DE RECOGIDA';
        }
    }
}