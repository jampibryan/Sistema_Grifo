<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GraficoController extends Controller
{
 
    public function dashboard(){

        //Todos los combustibles
        $gasolinas = Producto::where('categoria_id','11')->get(); //cambiar id por descripcion, gasolina,etc
        $petroleos =  Producto::where('categoria_id','10')->get();
        $combustibles = $gasolinas->concat($petroleos);

        $comestibles = Producto::where('descripcion','Comestibles')->get();

        $aceites = Producto::where('descripcion','Aceites')->get();
        $lubricantes = Producto::where('descripcion','Lubricantes')->get();
        $aceilubris = $aceites->concat($lubricantes);

        $VentasProducto = DetalleVenta::all();  

        $listaCombustibles = ['producto' => [], 'cantidad'=> []];
        $listaComestibles = ['producto' => [], 'cantidad'=> []];
        $listaAceiLubris = ['producto' => [], 'cantidad'=> []];

        //Ventas de combustibles registradas
        foreach ($combustibles as $c) { 
            $cantidad = 0;
            foreach ($VentasProducto as $v) { 
                if($c->id == $v->producto_id) {
                    $cantidad = $cantidad+$v->cantidad; 
                }
            } 
            array_push($listaCombustibles['cantidad'],$cantidad); 
            array_push($listaCombustibles['producto'],$c->descripcion);
        }
        $contadorCombustible = count($listaCombustibles['producto']);
        //.....

        //Ventas de comestibles registradas
        foreach ($comestibles as $co) { 
            $cantidad = 0;
            foreach ($VentasProducto as $v) { 
                if($co->id == $v->producto_id) {
                    $cantidad = $cantidad+$v->cantidad; 
                }
            } 
            array_push($listaComestibles['cantidad'],$cantidad); 
            array_push($listaComestibles['producto'],$co->descripcion);
        }
        $contadorComestible = count($listaComestibles['producto']);
        //.....

        //Ventas de aceites y lubricantes registradas
        foreach ($aceilubris as $al) { 
            $cantidad = 0;
            foreach ($VentasProducto as $v) { 
                if($al->id == $v->producto_id) {
                    $cantidad = $cantidad+$v->cantidad; 
                }
            } 
            array_push($listaAceiLubris['cantidad'],$cantidad); 
            array_push($listaAceiLubris['producto'],$al->descripcion);
        }
        $contadorAceiLubris = count($listaAceiLubris['producto']);
        //.....


        //Ventas por fechas
        $fecha = today();
        $nVentasT = Venta::all()->count();
        $nVentasHoy = Venta::whereDate('fecha', '=', $fecha->format('Y-m-d'))->count();
        $nVentasMes = Venta::whereMonth('fecha', '=', $fecha->format('m'))->count();
        $nVentasAño = Venta::whereYear('fecha', '=', $fecha->format('Y'))->count();
        //.....


        //Ventas mensuales
        $listaVentasMensuales=array();
        array_push($listaVentasMensuales,0);
        for ($i=1; $i < 13; $i++) { 
            $nVentasMensuales = Venta::whereMonth('fecha', '=', $i)->whereYear('fecha','=',$fecha->format('Y'))->count();
           array_push($listaVentasMensuales,$nVentasMensuales);
        }
        //.....


        return view('dashboard', compact('combustibles','contadorCombustible','contadorComestible','contadorAceiLubris','listaComestibles','listaCombustibles','listaAceiLubris','listaVentasMensuales','nVentasT','nVentasHoy','nVentasMes','nVentasAño'));
    }

    public function index(Request $request){
        $buscarpormes = $request->get('mes');
        $buscarporaño = $request->get('año');
        $ventas = Venta::all();
        $detalleVentas = DB::select("select p.descripcion as Producto, 	
                                            sum(dv.cantidad) as Cantidad,
                                            sum(v.total) as Total
                                            from ventas v 
                                            inner join detalle_ventas dv on v.id = dv.venta_id
                                            inner join productos p on dv.producto_id = p.id
                                            where month(v.fecha) = ? and year(v.fecha) = ?
                                        group by p.descripcion",[$buscarpormes,$buscarporaño]);

        $meses = [];
        $años = [];
        
        $mesesNombre = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        foreach ($ventas as $v) {
            $mes = date('m',strtotime($v->fecha));
            array_push($meses,(int) $mes -1);
        }
        $mesesunique =array_unique($meses);

        foreach ($ventas as $v) {
            $año = date('Y',strtotime($v->fecha));
            array_push($años,$año);
        }
        $añosunique =array_unique($años);
        
        return view('Proyecto.Reportes.balancegeneral',compact('mesesNombre','mesesunique','añosunique','detalleVentas','ventas'));
    } 
}
