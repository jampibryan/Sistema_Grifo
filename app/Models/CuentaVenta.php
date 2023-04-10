<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaVenta extends Model
{
    use HasFactory;
    protected $table = 'cuenta_ventas';
    protected $fillable = [
        'cuenta_id',
        'venta_id'
    ];
    public $timestamps = false;
}
