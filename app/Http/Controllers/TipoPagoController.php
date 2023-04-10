<?php

namespace App\Http\Controllers;

use App\Models\TipoPago;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $TipoPago=TipoPago::all();
        return view('Proyecto.TipoPago.index',compact('TipoPago'));
    }
}
