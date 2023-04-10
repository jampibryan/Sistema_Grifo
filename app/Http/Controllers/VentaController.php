<?php

namespace App\Http\Controllers;

use App\Http\Requests\Venta\StoreRequest;
use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:venta.index')->only('index','ventapdf','imprimir','show');
        $this->middleware('can:venta.create')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = DB::select('select id,cast(fecha as date) as fecha,total,estado from ventas');
        return view('Proyecto.venta.index', compact('ventas'));
    }

    public function dashboard(){

        return view('dashboard');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        $tipo = TipoPago::all();
        return view('Proyecto.venta.create',compact('clientes','productos','tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $venta = Venta::create($request->all()+[
            'user_id' => Auth::user()->id,
            'fecha' => now(),
            'igv' => 18
        ]);


        foreach ($request->producto_id as $key => $id) {
            $venta->actualiza_stock($request->producto_id[$key],$request->cantidad[$key]);
            $dataDetalle[] = array("producto_id"=>$request->producto_id[$key],"cantidad"=>$request->cantidad[$key],"precio"=>$request->precio[$key],"subtotal"=>$request->cantidad[$key]*$request->precio[$key]);
        }        
        
        for ($i=0; $i < sizeof($dataDetalle); $i++) {            
            $detalle = new DetalleVenta();
            $detalle->venta_id = $venta->id;
            $detalle->producto_id = $dataDetalle[$i]["producto_id"];
            $detalle->cantidad = $dataDetalle[$i]["cantidad"];
            $detalle->precio = $dataDetalle[$i]["precio"];
            $detalle->subtotal = $dataDetalle[$i]["subtotal"];
            $detalle->save();
        }
        return redirect()->route('venta.index')->with('msj','Venta registrada con éxito!');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $venta = DB::select('select c.nombre,u.name,u.apellidos,v.id,v.estado,v.total,v.igv,tp.descripcionTipoPago from ventas v inner join clientes c on c.id = v.cliente_id inner join users u on u.id = v.user_id inner join tipo_pagos tp on tp.id = v.tipo_id where v.id = ?', [$id]);

        $detalles = DB::select('select p.descripcion,dv.precio,dv.cantidad,dv.subtotal from ventas v inner join detalle_ventas dv on v.id = dv.venta_id inner join productos p on p.id = dv.producto_id where dv.venta_id = ?',[$id]);

        return view('Proyecto.venta.show', compact('detalles','venta'));
    }

    public function update(Request $request, $id) {        
        $venta = Venta::find($id);
        $venta->estado = $request->estado;
        $venta->save();
        return back()->with('msj','Actualización exitosa!!');
    }

    public function destroy(Venta $ventum)
    {

    }

    public function contactos(){
        $users = User::all();
        return view('Proyecto.contactos',compact('users'));
    }

    public function imprimir()
    {
        $ventas = Venta::whereDate('fecha' ,Carbon::today())->get();
        $total = $ventas->sum('total');
        $pdf = \PDF::loadView('proyecto.venta.reporte',compact('ventas','total'));
        
        return $pdf->stream('Ventas.pdf');
    }

    public function ventapdf($id) {
        $venta = DB::select('select c.nombre,u.name,u.apellidos,v.id,v.estado,v.total,v.igv,tp.descripcionTipoPago from ventas v inner join clientes c on c.id = v.cliente_id inner join users u on u.id = v.user_id inner join tipo_pagos tp on tp.id = v.tipo_id where v.id = ?', [$id]);

        $detalles = DB::select('select p.descripcion,dv.precio,dv.cantidad,dv.subtotal from ventas v inner join detalle_ventas dv on v.id = dv.venta_id inner join productos p on p.id = dv.producto_id where dv.venta_id = ?',[$id]);
        
        $pdf = \PDF::loadView('proyecto.venta.pdf',compact('venta','detalles'));
        return $pdf->stream('Ventas.pdf');
    }
}
