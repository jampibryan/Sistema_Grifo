<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fecha',
        'total'
    ];
    public $timestamps = false;

    public function ver($id) {
        $venta = Venta::find($id);
        $venta->encuenta = "si";
        $venta->save();
    }
}
