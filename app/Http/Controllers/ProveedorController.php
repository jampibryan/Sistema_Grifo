<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:compra.create');
    }

    public function index()
    {
        $proveedores = Proveedor::all();
        return view('Proyecto.proveedor.index',compact('proveedores'));
    }

    public function create()
    {
        return view('Proyecto.proveedor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'RUC' => 'required|numeric',
            'nombre' => 'required',
            'email' => 'required|email',
            'direccion' => 'required',
            'telefono' => 'required|numeric'
        ],[
            'RUC.required' => 'Este campo es obligatorio.',
            'RUC.numeric' => 'Este campo es obligatorio.',
            'nombre.required' => 'Este campo es obligatorio.',
            'email.required' => 'Este campo es obligatorio.',
            'email.email' => 'Este campo es de tipo email',
            'direccion.required' => 'Este campo es obligatorio.',
            'telefono.required' => 'Este campo es obligatorio.',
            'telefono.numeric' => 'Es te campo es numérico'
        ]);

        $proveedores= new Proveedor();
        $proveedores->RUC = $request->RUC;
        $proveedores->nombre = $request->nombre;
        $proveedores->email = $request->email;
        $proveedores->direccion = $request->direccion;
        $proveedores->telefono = $request->telefono;
        $proveedores->save();
        return redirect()->route('proveedores.index')->with('msj','Proveedor agregado con éxito!');
    }

    public function edit($Proveedor)
    {
        $proveedores = Proveedor::findOrFail($Proveedor);
        return view('Proyecto.proveedor.edit',compact('proveedores'));
    }
    public function update(Request $request,$id)
    {
        $proveedores = Proveedor::findOrFail($id);
        $proveedores->RUC = $request->RUC;
        $proveedores->nombre = $request->nombre;
        $proveedores->email = $request->email;
        $proveedores->direccion = $request->direccion;
        $proveedores->telefono = $request->telefono;
        $proveedores->save();
        return Redirect()->route('proveedores.index')->with('msj','Proveedor actualizado!');
    }

    public function destroy($id)
    {
        $proveedores = Proveedor::find($id);
        $proveedores->delete();
        return redirect()->route('proveedores.index');
    }
}
