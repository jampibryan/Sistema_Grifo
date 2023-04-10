<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create(['cantidad'=>'1000','precio'=>'16.79','descripcion'=>'Gasolina de 90','categoria_id'=>11,'unidaddemedida'=>'Galones']);
        Producto::create(['cantidad'=>'8000','precio'=>'16.99','descripcion'=>'Gasolina de 84','categoria_id'=>11,'unidaddemedida'=>'Galones']);
        Producto::create(['cantidad'=>'9000','precio'=>'17.89','descripcion'=>'Gasolina de 95','categoria_id'=>11,'unidaddemedida'=>'Galones']);
        Producto::create(['cantidad'=>'1200','precio'=>'13.45','descripcion'=>'Petroleo(diésel)','categoria_id'=>10,'unidaddemedida'=>'Galones']);
    }
}

