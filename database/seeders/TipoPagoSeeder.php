<?php

namespace Database\Seeders;
use App\Models\TipoPago;
use Illuminate\Database\Seeder;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPago::create(['descripcionTipoPago'=>'Contado']);
        TipoPago::create(['descripcionTipoPago'=>'Credito']);
        //TipoPago::create(['descripcionTipoPago'=>'Tarjeta']);
    }
}
