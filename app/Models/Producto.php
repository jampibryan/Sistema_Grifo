<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'precio',
        'descripcion',
        'categoria_id',
        'unidaddemedida'
    ];

    public $timestamps = false;

    public function suma_stock($cantidad) {
        $this->increment('cantidad', $cantidad);
    }

    public function resta_stock($cantidad) {
        $this->decrement('cantidad', $cantidad);
    }
}
