<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol1 = Role::create(['name' => 'Vendedor', 'sueldo' => 960.00]);
        $rol2 = Role::create(['name' => 'Administrador', 'sueldo' => 2000.00]);
        $rol3 = Role::create(['name' => 'Asistente de almacen', 'sueldo' => 960.00]);
        $rol4 = Role::create(['name' => 'Gerente Comercial', 'sueldo' => 3000.00]);
        $rol5 = Role::create(['name' => 'Contador', 'sueldo' => 3500.00]);
        $rol6 = Role::create(['name' => 'Supervisor', 'sueldo' => 1200.00]);
        $rol7 = Role::create(['name' => 'Secretaria', 'sueldo' => 1500.00]);
        $rol8 = Role::create(['name' => 'Administrador del sistema', 'sueldo' => 2500.00]);
        $rol9 = Role::create(['name' => 'Transportista', 'sueldo' => 1800.00]);
        
        // PERMISOS VENDEDOR
        Permission::create(['name' => 'producto.index'])->syncRoles([$rol1, $rol2, $rol4, $rol3, $rol6]);
        Permission::create(['name' => 'cliente.index'])->syncRoles([$rol1]);
        Permission::create(['name' => 'cliente.create'])->syncRoles([$rol1]);
        Permission::create(['name' => 'venta.index'])->syncRoles([$rol1,$rol7]);
        Permission::create(['name' => 'venta.reporte'])->syncRoles([$rol7]);
        Permission::create(['name' => 'venta.create'])->syncRoles([$rol1]);
        Permission::create(['name' => 'venta.comprobante'])->syncRoles([$rol1]);

        // PERMISOS ADMINISTRADOR
        Permission::create(['name' => 'vendedor.index'])->syncRoles([$rol2]);
        Permission::create(['name' => 'compra.index'])->syncRoles([$rol2, $rol3, $rol4, $rol5]);
        Permission::create(['name' => 'compra.reporte'])->syncRoles([$rol3]);
        Permission::create(['name' => 'compra.detalle'])->syncRoles([$rol3]);

        // PERMISOS Asistente de almacen
        Permission::create(['name' => 'producto.edit'])->syncRoles([$rol3, $rol6]);


        //  PERMISOS Gerente Comercial
        Permission::create(['name' => 'compra.create'])->syncRoles([$rol4]);
        Permission::create(['name' => 'compra.edit'])->syncRoles([$rol4, $rol2]);

        //  PERMISOS Contador
        Permission::create(['name' => 'reporte.balance'])->syncRoles([$rol5]);
        // registrar gasto de abastecimiento
        

        //  PERMISOS Supervisor
        Permission::create(['name' => 'producto.reporte'])->syncRoles([$rol6]);
        Permission::create(['name' => 'producto.create'])->syncRoles([$rol6]);

        Permission::create(['name' => 'cuenta.index'])->syncRoles([$rol1, $rol7]);
        Permission::create(['name' => 'cuenta.create'])->syncRoles([$rol1]);

        //  PERMISOS Secretaria
        // Permission::create(['name' => 'producto.edit'])->syncRoles([$rol7]);
        

        //  PERMISOS Administrador del sistema
        Permission::create(['name' => 'usuario.index'])->syncRoles([$rol8,$rol2]);
        Permission::create(['name' => 'usuario.create'])->syncRoles([$rol8,$rol2]);
        Permission::create(['name' => 'usuario.edit'])->syncRoles([$rol8,$rol2]);
        Permission::create(['name' => 'usuario.detalle'])->syncRoles([$rol2]);
    }
}