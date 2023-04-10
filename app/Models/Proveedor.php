<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $fillable = [
        'RUC',
        'nombre',
        'email',
        'direccion',
        'telefono'
    ];

    public $timestamps = false;
}
