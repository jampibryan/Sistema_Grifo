<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:producto.index')->only('index');
        $this->middleware('can:producto.create')->only('create');
        $this->middleware('can:producto.reporte')->only('imprimir');
        $this->middleware('can:producto.edit')->only('edit');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = DB::select('select p.id as id,p.descripcion as descripcion,p.unidaddemedida, c.descripcion as descripcionc,p.cantidad as cantidad, p.precio as precio from productos p inner join categorias c on c.id = p.categoria_id');
        
        return view('Proyecto.producto.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('Proyecto.producto.create', compact('categorias','proveedores'));
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric',
            'descripcion' => 'required',
            'categoria_id' => 'required'
        ],[
            'cantidad.required' => 'Este campo es obligatorio',
            'cantidad.numeric' => 'Solo números',
            'precio.required' => 'Este campo es obligatorio',
            'precio.numeric' => 'Solo números',
            'descripcion.required' => 'Este campo es obligatorio',
            'categoria_id.required' => 'Este campo es obligatorio'
        ]);
        Producto::create($request->all());
        return redirect()->route('producto.index')->with('msj','Producto creado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function imprimir()
    {
        $producto = DB::table('productos as p')
                ->join('categorias as pr', 'pr.id','=','p.categoria_id')
                ->select('p.id','p.descripcion','p.cantidad','p.precio','pr.descripcion as categorias')
                ->get();
        $pdf = \PDF::loadView('proyecto.producto.reporte',compact('producto'));

        return $pdf->stream('productos.pdf');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        
        $producto=Producto::find($producto->id);
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('Proyecto.producto.edit',compact('producto','categorias','proveedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric',
            'descripcion' => 'required',
            'categoria_id' => 'required'
        ],[
            'cantidad.required' => 'Este campo es obligatorio',
            'cantidad.numeric' => 'Solo números',
            'precio.required' => 'Este campo es obligatorio',
            'precio.numeric' => 'Solo números',
            'descripcion.required' => 'Este campo es obligatorio',
            'categoria_id.required' => 'Este campo es obligatorio'
        ]);
        
        $producto->update($request->all());
        return redirect()->route('producto.index')->with('msj','Producto modificado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        Producto::find($producto->id)->delete();
        return redirect('producto');
    }
}
