<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'igv',
        'total',
        'estado',
        'fechaEmision',
        'fechaEntrega',
        'proveedor_id',
        'user_id'
    ];
    // public $timestamps = false;

    public function actualiza_stock($id, $cantidad) {
        $producto = Producto::find($id);
        $producto->suma_stock($cantidad);
    }

    public function item_detalle($id,$idproducto,$cantidad) {
        $detalle = DB::select('select * from detalle_compras where compra_id = ? and producto_id = ?',[$id, $idproducto]);
        $id = $detalle[0]->id;
        $xdetalle = DetalleCompra::find($id);
        $xdetalle->cantidad_recibida = $cantidad;
        $xdetalle->save();
    }
}
