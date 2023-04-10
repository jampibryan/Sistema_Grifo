<?php

namespace Database\Seeders;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(['descripcion'=>'Empaquetados']);
        Categoria::create(['descripcion'=>'Bebidas']);
        Categoria::create(['descripcion'=>'Comestibles']);
        Categoria::create(['descripcion'=>'Preservativos']);
        Categoria::create(['descripcion'=>'No Empaquetados']);
        Categoria::create(['descripcion'=>'Galletas']);
        Categoria::create(['descripcion'=>'Chocolates']);
        Categoria::create(['descripcion'=>'Gaseosas']);
        Categoria::create(['descripcion'=>'jugos']);
        Categoria::create(['descripcion'=>'Petroleo']);
        Categoria::create(['descripcion'=>'Gasolina']);
        Categoria::create(['descripcion'=>'Aceites']);
        Categoria::create(['descripcion'=>'Lubricantes']);
    }
}
