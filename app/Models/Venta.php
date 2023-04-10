<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $dates = ['name_field'];
    protected $fillable = [
        'fecha',
        'igv',
        'total',
        'estado',
        'cliente_id',
        'user_id',
        'tipo_id'
    ];

    // public $timestamps = false;

    public function actualiza_stock($id, $cantidad) {
        $producto = Producto::find($id);
        $producto->resta_stock($cantidad);
    }
}
