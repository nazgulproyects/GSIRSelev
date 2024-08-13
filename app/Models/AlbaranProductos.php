<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbaranProductos extends Model{
    use HasFactory;

    //protected $connection = '';
    protected $table = 'albaran_productos';

    public function producto()
    {
        return $this->belongsTo('App\Models\Productos', 'producto_id');
    }
}