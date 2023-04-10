<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\CuentaVenta;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CuentaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('can:cuenta.create')->only('create');
    }

    public function index() {
        $idActual = Auth::user()->id;
        $cuentas = Cuenta::where('user_id',$idActual)->get();
        $cuentax = Cuenta::all();
        return view('Proyecto.cuenta.index', compact('cuentas','cuentax'));
    }

    public function create() {
        $idActual = Auth::user()->id;
        $diaHoy = date('d');
        $ventas = DB::select('select id,fecha,total from ventas where user_id = ? and day(fecha) = ? and encuenta = ?',[$idActual,$diaHoy,"no"]);
        $tam = sizeof($ventas);
        return view('Proyecto.cuenta.create',compact('ventas','tam'));
    }

    public function store(Request $request) {
        $suma = 0;
        for ($i=0; $i < sizeof($request->utotal); $i++) { 
            $suma += $request->utotal[$i];
        }

        $cuenta = Cuenta::create([
            'user_id' => Auth::user()->id,
            'fecha' => now(),
            'total' => $suma
        ]);

        foreach ($request->ids as $key => $value) {
            $cuenta->ver($request->ids[$key]);
            $data[] = array("venta_id"=>$request->ids[$key]);
        }

        for ($i=0; $i < sizeof($data) ; $i++) { 
            $detalleCuenta = new CuentaVenta();
            $detalleCuenta->venta_id = $data[$i]["venta_id"];
            $detalleCuenta->cuenta_id = $cuenta->id;
            $detalleCuenta->save();
        }

        return redirect()->route('cuenta.index')->with('msj','Cuenta registrada con éxito!');
    }
}
