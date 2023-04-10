<?php

namespace Database\Seeders;
use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedor::create(['RUC'=>'19287283729','nombre'=>'Petrodelsac','email'=>'PetroSac_peru20@gmail.com','direccion'=>'Lima Mercedes 8728','telefono'=>'018262933']);
        Proveedor::create(['RUC'=>'19282638273','nombre'=>'BebiblesSac','email'=>'Bebic_Guda98@gmail.com','direccion'=>'Guadalupe Saucedo 627','telefono'=>'912324532']);
        Proveedor::create(['RUC'=>'10192672823','nombre'=>'AbarrocPeru','email'=>'AbarrocP_09@gmail.com','direccion'=>'Chepen Clit 627','telefono'=>'928972032']);
        Proveedor::create(['RUC'=>'13232244553','nombre'=>'Gasolperu','email'=>'GasolPeru:07@gmail.com','direccion'=>'Chiclayo ventina 627','telefono'=>'934345334']);
    }
}
