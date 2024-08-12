<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoRecogida extends Model{
    use HasFactory;

    //protected $connection = '';
    protected $table = 'puntos_recogida';

    public function cli_prov()
    {
        return $this->belongsTo('App\Models\CliProv', 'cli_prov_id');
    }

    public function contrato()
    {
        return $this->belongsTo('App\Models\Contratos', 'asignado_a_contrato');
    }

    public function getNombreCliProvAttribute()
    {
        if ($this->cli_prov_id != null) {
            return $this->cli_prov->nombre;
        } else {
            return 'SIN CLIENTE/PROVEEDOR';
        }
    }

    public function getNombreContratoAttribute()
    {
        if ($this->asignado_a_contrato != null) {
            return $this->contrato->codigo;
        } else {
            return 'SIN CONTRATO';
        }
    }
}