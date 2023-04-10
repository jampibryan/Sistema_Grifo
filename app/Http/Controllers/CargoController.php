<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cargo\StoreRequest;
use App\Http\Requests\Cargo\UpdateRequest;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:usuario.index');
    }
    public function index()
    {
        $cargos=Cargo::all();
        return view('Proyecto.Cargos.index',compact('cargos'));
    }
    public function create()
    {
        return view('Proyecto.Cargos.create');
    }

    public function store(StoreRequest $request)
    {
        $cargos= new Cargo();
        $cargos->descripcioncargo = $request->descripcion;
        $cargos->sueldo = $request->sueldo;
        $cargos->save();
        Role::create([
            'name' => $request->descripcion,
            'sueldo' => $request->sueldo
        ]);
        return redirect()->route('cargo.index')->with('msj','Cargo agregado con éxito!');
    }
    
    public function edit($Cargo)
    {
        $cargos = Cargo::findOrFail($Cargo);
        return view('Proyecto.Cargos.edit',compact('cargos'));
    }
    public function update(UpdateRequest $request,Cargo $cargo)
    {
        $rol = Role::where('name',$cargo->descripcioncargo)->get();
        $rol[0]["name"] = $request->descripcion;
        $id = $rol[0]["id"];

        $cargo->descripcioncargo = $request->descripcion;
        $cargo->sueldo = $request->sueldo;
        $cargo->save();

        $xrol = Role::find($id);
        $xrol->name = $rol[0]["name"];
        $xrol->save();

        return Redirect()->route('cargo.index')->with('msj','Cargo actualizado!');
    }

    public function destroy($id)
    {
        $cargos = Cargo::find($id);
        $cargos->delete();
        return redirect()->route('cargo.index');
    }
}
