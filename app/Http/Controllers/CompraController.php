<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TransporteCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:compra.index')->only('index','show');
        $this->middleware('can:compra.edit')->only('edit');
        $this->middleware('can:compra.reporte')->only('reporteCF');
        $this->middleware('can:compra.create')->only('create');
    }
    public function index() {
        $compras = DB::select('select id,cast(fechaEmision as date) as fecha,total,estado from compras');
        return view('Proyecto.compra.index', compact('compras'));
    }

    public function create() {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $transportistas = DB::select('select u.id,u.name,u.apellidos from users u inner join cargos c on c.id = u.cargo_id where c.descripcioncargo = ? and u.estado = ?',["Transportista","ACTIVO"]);
        return view('Proyecto.compra.create', compact('proveedores','productos','transportistas'));
    }

    public function store(Request $request) {
        $compra = Compra::create($request->all()+[
            'user_id' => Auth::user()->id,
            'fechaEmision' => now(),
            'igv' => 18
        ]);

        foreach ($request->producto_id as $key => $value) {
            $compra->actualiza_stock($request->producto_id[$key],$request->cantidad[$key]);
            $dataDetalle[] = array("producto_id"=>$request->producto_id[$key],"precio"=>$request->precio[$key],"cantidad"=>$request->cantidad[$key],"subtotal"=>$request->precio[$key]*$request->cantidad[$key]);
        }

        for ($i=0; $i < sizeof($dataDetalle); $i++) { 
            $detalle = new DetalleCompra();
            $detalle->compra_id = $compra->id;
            $detalle->producto_id = $dataDetalle[$i]["producto_id"];
            $detalle->precio = $dataDetalle[$i]["precio"];
            $detalle->cantidad = $dataDetalle[$i]["cantidad"];
            $detalle->subtotal = $dataDetalle[$i]["subtotal"];
            $detalle->save();
        }

        $trCompra = new TransporteCompra();
        $trCompra->compra_id = $compra->id;
        $trCompra->user_id = $request->tran_id;
        $trCompra->save();

        return redirect()->route('compra.index')->with('msj','Compra exitosa!!');
    }

    public function show($id) {
        $compra = DB::select('select c.id,pr.nombre,u.name,u.apellidos,c.estado,c.fechaEmision,cast(c.fechaEntrega as date) as fechaEntrega,c.total,c.igv from compras c inner join proveedors pr on pr.id=c.proveedor_id inner join users u on u.id=c.user_id where c.id = ?', [$id]);

        $transportista = DB::select('select u.name,u.apellidos from transporte_compras tc inner join users u on u.id = tc.user_id where tc.compra_id = ? ',[$id]);

        $detalles = DB::select('select p.descripcion,dc.precio,dc.cantidad,dc.subtotal,dc.cantidad_recibida from detalle_compras dc inner join productos p on p.id = dc.producto_id where dc.compra_id = ?',[$id]);

        return view('Proyecto.compra.show', compact('compra','detalles','transportista'));
    }

    public function edit($id) {
        $compra = DB::select('select c.id,pr.nombre,u.name,u.apellidos,c.estado,c.fechaEmision,cast(c.fechaEntrega as date) as fechaEntrega,c.total,c.igv from compras c inner join proveedors pr on pr.id=c.proveedor_id inner join users u on u.id=c.user_id where c.id = ?', [$id]);

        return view('Proyecto.compra.edit', compact('compra'));
    }

    public function update(Request $request, $id) {
        $compra = Compra::find($id);
        $compra->estado = $request->estado;
        $compra->save();
        return back()->with('msj','Actualización exitosa!!');
    }

    public function cambioFecha(Request $request, $id) {
        if ($request->newFecha != "") {
            $fechaHoy = strtotime(date("Y-m-d"));
            $fechaHtml = strtotime($request->newFecha);
            if ($fechaHtml < $fechaHoy ) {
                return back()->with('merror','La fecha debe ser mayor a la hoy!!');                
            } else {
                $compra = Compra::find($id);
                $compra->fechaEntrega = $request->newFecha;
                $compra->save();
                return back()->with('msj','Cambio Exitoso!!');                
            }   
        } else {
            return back()->with('merror','El campo de la fecha es obligatorio!!');
        }
    }

    public function registro($id) {
        $compra = DB::select('select c.id,pr.nombre,u.name,u.apellidos,c.estado,c.fechaEmision,cast(c.fechaEntrega as date) as fechaEntrega,c.total,c.igv from compras c inner join proveedors pr on pr.id=c.proveedor_id inner join users u on u.id=c.user_id where c.id = ?', [$id]);

        $transportista = DB::select('select u.name,u.apellidos from transporte_compras tc inner join users u on u.id = tc.user_id where tc.compra_id = ? ',[$id]);

        $detalles = DB::select('select p.id,p.descripcion,dc.precio,dc.cantidad,dc.subtotal,dc.cantidad_recibida from detalle_compras dc inner join productos p on p.id = dc.producto_id where dc.compra_id = ?',[$id]);

        return view('Proyecto.compra.modificacion', compact('compra','transportista','detalles'));
    }

    public function entrega(Request $request, $id) {
        $compra = Compra::find($id);
        foreach ($request->producto_id as $key => $value) {
            $compra->item_detalle($compra->id,$request->producto_id[$key],$request->cantidad_entrega[$key]);
        }
        $compra->estado = "RECIBIDA";
        $compra->save();
        return redirect()->route('compra.index');
    }

    public function reporteCF($id){
        $compra = DB::select('select c.id,pr.nombre,u.name,u.apellidos,c.estado,c.fechaEmision,cast(c.fechaEntrega as date) as fechaEntrega,c.total,c.igv from compras c inner join proveedors pr on pr.id=c.proveedor_id inner join users u on u.id=c.user_id where c.id = ?', [$id]);

        $transportista = DB::select('select u.name,u.apellidos from transporte_compras tc inner join users u on u.id = tc.user_id where tc.compra_id = ? ',[$id]);

        $detalles = DB::select('select p.descripcion,dc.precio,dc.cantidad,dc.subtotal,dc.cantidad_recibida from detalle_compras dc inner join productos p on p.id = dc.producto_id where dc.compra_id = ?',[$id]);

        $pdf = \PDF::loadview('Proyecto.compra.reportes.cFaltante', compact('compra','detalles','transportista'));
        return $pdf->stream("1.pdf");

    }
}
