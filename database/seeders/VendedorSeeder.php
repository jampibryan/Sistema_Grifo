<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'dni' => '79372493',
            'name' => 'Gino',
            'estado' => 'ACTIVO',
            'direccion' => 'Pacasmayo',
            'genero' => 'M',
            'fechanacimiento' => '1995-06-06',
            'apellidos' => 'bardalez alvarez',
            'telefono' => '933321734',
            'email' => 'GinoBa@gmail.com',
            'password' => bcrypt('password'),
            'cargo_id' => '1'
        ])->assignRole("Vendedor");
        User::create([
            'dni' => '76347288',
            'name' => 'Bryan',
            'estado' => 'ACTIVO',
            'direccion' => 'Pacasmayo',
            'genero' => 'M',
            'fechanacimiento' => '1999-11-04',
            'apellidos' => 'Amaya Culqui',
            'telefono' => '935172287',
            'email' => 'bryancc@gmail.com',
            'password' => bcrypt('password'),
            'cargo_id' => '2'
        ])->assignRole("Administrador");
        User::create([
            'dni' => '75397439',
            'name' => 'Cristiano',
            'estado' => 'ACTIVO',
            'direccion' => 'Pacasmayo',
            'genero' => 'M',
            'fechanacimiento' => '2000-03-05',
            'apellidos' => 'Guanilo Gutierrez',
            'telefono' => '964827284',
            'email' => 'crisg@gmail.com',
            'password' => bcrypt('password'),
            'cargo_id' => '3'
        ])->assignRole("Asistente de almacen");
        User::create([
            'dni' => '76384782',
            'name' => 'Angel',
            'estado' => 'ACTIVO',
            'direccion' => 'Pacasmayo',
            'genero' => 'M',
            'fechanacimiento' => '2000-02-09',
            'apellidos' => 'Bardalez Rios',
            'telefono' => '976384783',
            'email' => 'angelb@gmail.com',
            'password' => bcrypt('password'),
            'cargo_id' => '4'
        ])->assignRole("Gerente Comercial");
        User::create([
            'dni' => '76483783',
            'name' => 'Billy',
            'estado' => 'ACTIVO',
            'direccion' => 'Pacasmayo',
            'genero' => 'M',
            'fechanacimiento' => '1998-03-03',
            'apellidos' => 'Revilla Rios',
            'telefono' => '968476832',
            'email' => 'billyr@gmail.com',
            'password' => bcrypt('password'),
            'cargo_id' => '5'
        ])->assignRole("Contador");
        User::create([
            'dni' => '76394729',
            'name' => 'Elvis',
            'estado' => 'ACTIVO',
            'direccion' => 'Pacasmayo',
            'genero' => 'M',
            'fechanacimiento' => '2000-06-05',
            'apellidos' => 'Torres Silva',
            'telefono' => '973847922',
            'email' => 'elvist@gmail.com',
            'password' => bcrypt('password'),
            'cargo_id' => '6'
        ])->assignRole("Supervisor");
        User::create([
            'dni' => '87483175',
            'name' => 'Iván',
            'estado' => 'ACTIVO',
            'direccion' => 'Pacasmayo',
            'genero' => 'M',
            'fechanacimiento' => '1999-05-10',
            'apellidos' => 'Oliveira Suarez',
            'telefono' => '984824834',
            'email' => 'ivano@gmail.com',
            'password' => bcrypt('password'),
            'cargo_id' => '7'
        ])->assignRole("Secretaria");
        User::create([
            'dni' => '87483175',
            'name' => 'Maria',
            'estado' => 'ACTIVO',
            'direccion' => 'Pacasmayo',
            'genero' => 'M',
            'fechanacimiento' => '1994-08-12',
            'apellidos' => 'Castro Garcia',
            'telefono' => '973837472',
            'email' => 'mariac@gmail.com',
            'password' => bcrypt('password'),
            'cargo_id' => '8'
        ])->assignRole("Administrador del sistema");
        User::create([
            'dni' => '45242153',
            'name' => 'Rafael',
            'estado' => 'ACTIVO',
            'direccion' => 'Pacasmayo',
            'genero' => 'M',
            'fechanacimiento' => '1996-01-03',
            'apellidos' => 'Guerrero Farfán',
            'telefono' => '984765937',
            'email' => 'rafelgf@gmail.com',
            'password' => bcrypt('password'),
            'cargo_id' => '9'
            ])->assignRole("Transportista");
        // ]);
    }
}

// HECHO POR BRYAN AMAYA