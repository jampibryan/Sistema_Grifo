<?php

namespace App\Http\Controllers;

// use App\Http\Requests\Categoria\StoreRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $contador = 0;
        $bol = true;
        $categorias = Categoria::all();
        return view('Proyecto.categoria.index', compact('categorias','contador','bol'));
    }
    public function edit($id){
        $categoria = Categoria::find($id);
        return view('Proyecto.categoria.editar',compact('categoria'));
    }
    public function store(Request $request){
        if ($request->descripcion == "") {
            return redirect()->route('categoria.index')->with('merror', 'Error: debe completar el campo descipricion!!');
        } else {
            Categoria::create($request->all()); 
            return redirect()->route('categoria.index')->with('msj', 'Categoría registrada');
        }
    }
    public function destroy($id){
        $categoria = Categoria::find($id);
        $categoria->delete();
        return redirect()->route('categoria.index');
    }
    public function update(Request $request, $categorium)
    {
        $categoria = Categoria::findOrFail($categorium);
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
        return redirect()->route('categoria.index')->with('msj','Categoria modificada!'); 
        
    }
}
