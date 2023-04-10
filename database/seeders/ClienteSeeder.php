<?php

namespace Database\Seeders;
use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create(['nombre'=>'Juan Eduardo Vasquez Ramirez', 'email'=>'Juanedu_28@gmail.com','direccion'=>'Jr. Bolivar 673', 'telefono'=>'987367221','tipoCliente'=>'NATURAL','nroDocumento'=>'76283634']);
        Cliente::create(['nombre'=>'Maria Rosa Quilcate Moran', 'email'=>'MariaRosa12@gmail.com','direccion'=>'Jr. Atahualpa 623', 'telefono'=>'982435331','tipoCliente'=>'NATURAL','nroDocumento'=>'73443323']);
        Cliente::create(['nombre'=>'Julio Lucas Mariños Rosalez', 'email'=>'JulioLucas_11@gmail.com','direccion'=>'Jr. Guadalupe 789', 'telefono'=>'982445221','tipoCliente'=>'NATURAL','nroDocumento'=>'76212444']);
        Cliente::create(['nombre'=>'Xiomara Liset Flores  Bances', 'email'=>'Xiolis_10@gmail.com','direccion'=>'pueblo Nuevo', 'telefono'=>'923567521','tipoCliente'=>'NATURAL','nroDocumento'=>'72345732']);
        Cliente::create(['nombre'=>'Empresa MaquinariaPesada', 'email'=>'Empresamaqui_1@gmail.com','direccion'=>'Chepen', 'telefono'=>'923452521','tipoCliente'=>'JURIDICO','nroDocumento'=>'19273927293']);
        Cliente::create(['nombre'=>'Julian Succer S.A', 'email'=>'Succer_09_J@gmail.com','direccion'=>'Ciudad de Dios', 'telefono'=>'924432421','tipoCliente'=>'JURIDICO','nroDocumento'=>'19827372523']);
        Cliente::create(['nombre'=>'Municipalidad de Pacasmayo', 'email'=>'MuniGuada_01@gmail.com','direccion'=>'Guadalupe Lote-12', 'telefono'=>'924423452','tipoCliente'=>'JURIDICO','nroDocumento'=>'15433653331']);
        Cliente::create(['nombre'=>'Municipalida de Chepen', 'email'=>'MuniChepen1232@gmail.com','direccion'=>'Chepen Atahualpa-1243', 'telefono'=>'997796541','tipoCliente'=>'JURIDICO','nroDocumento'=>'19875455335']);
        Cliente::create(['nombre'=>'Maria Josefina Saucedo Guzman', 'email'=>'MarianJose_Real@gmail.com','direccion'=>'Jr. Sucre 0922', 'telefono'=>'923453322','tipoCliente'=>'NATURAL','nroDocumento'=>'78261838']);
        Cliente::create(['nombre'=>'Reyna Del Pescado', 'email'=>'ReyPescad_09@gmail.com','direccion'=>'Jr. Salaverry 1726', 'telefono'=>'923453532','tipoCliente'=>'JURIDICO','nroDocumento'=>'19018966822']);
    }
}
