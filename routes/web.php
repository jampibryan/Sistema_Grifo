<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\GraficoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\TipoPagoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',[GraficoController::class, 'dashboard'])->name('dashboard');

Route::resource('cliente', ClienteController::class);
Route::resource('producto', ProductoController::class);
Route::resource('venta', VentaController::class);
Route::resource('vendedor', VendedorController::class);
Route::resource('categoria',CategoriaController::class);
Route::resource('TipoPago',TipoPagoController::class);
Route::resource('cargo',CargoController::class);
Route::resource('compra',CompraController::class);
Route::resource('proveedores',ProveedorController::class);

Route::get('productos/imprimir',[ProductoController::class, 'imprimir'])->name('producto.imprimir');
Route::get('ventas/imprimir',[VentaController::class, 'imprimir'])->name('ventas.imprimir');
Route::get('ventaspdf/{id}',[VentaController::class, 'ventapdf'])->name('ventas.ventapdf');
Route::get('compras/{id}',[CompraController::class, 'registro'])->name('compra.registro');
Route::put('entrega/{id}',[CompraController::class, 'entrega'])->name('compra.entrega');

Route::resource('cuenta',CuentaController::class);
Route::get('deletevendedor/{id}', [VendedorController::class, 'inhabilitar'])->name('inhabilitar');
Route::get('contactos', [VentaController::class, 'contactos'])->name('contactos');
Route::put('cambiofecha/{id}',[CompraController::class, 'cambioFecha'])->name('cambioFecha');
Route::get('compra/reporte/cantidadfaltante/{id}',[CompraController::class,'reporteCF'])->name('compra.reporteCF');
Route::get('balance',[GraficoController::class,'index'])->name('balance');
Route::get('empleadosInhabilitados',[VendedorController::class,'indexInhabilitados'])->name('vendedor.index2');
Route::get('habilitarempleado/{id}',[VendedorController::class,'habilitar'])->name('vendeddor.habilitar');