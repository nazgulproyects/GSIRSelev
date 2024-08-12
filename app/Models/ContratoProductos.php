<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoProductos extends Model{
    use HasFactory;

    //protected $connection = '';
    protected $table = 'contrato_productos';

    public function producto()
    {
        return $this->belongsTo('App\Models\Productos', 'producto_id');
    }
}