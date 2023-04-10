<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vendedor\StoreRequest;
use App\Http\Requests\Vendedor\UpdateRequest;
use App\Models\Cargo;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class VendedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:usuario.index')->only('index');
        $this->middleware('can:usuario.create')->only('create');
        $this->middleware('can:usuario.edit')->only('show','edit','inhabilitar');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $vendedores = DB::select('select u.id,u.name,u.apellidos,u.telefono,u.email,u.estado,c.descripcioncargo from users u inner join cargos c on c.id=u.cargo_id');
        $auxvend = Auth()->user()->id;
        return view('Proyecto.vendedor.index',compact('vendedores','auxvend'));
    }

    public function indexInhabilitados()
    {
        $vendedores = DB::select('select id,name,apellidos,dni from users where estado = ?', ["INACTIVO"]);
        return view('Proyecto.vendedor.index2',compact('vendedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargo::all();
        return view('Proyecto.vendedor.create',compact('cargos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($request->txtcargo == 'Transportista') {
            $usuario = User::create($request->all());
            return redirect()->route('vendedor.index')->with('msj','Usuario creado con éxito!');
        }
        else {
            $rol = Role::select('name')->where('name',$request->txtcargo)->get();
            $xrol = $rol[0]["name"];
            $usuario = User::create($request->all()+[
                
                'password' => bcrypt('password')
            ]);
            
            $usuario->syncRoles($xrol);

            return redirect()->route('vendedor.index')->with('msj','Usuario creado con éxito!');
        }
    }

    public function show($id)
    {
        $vendedor=User::find($id);
        return view('Proyecto.vendedor.show',compact('vendedor'));
    }

    public function edit(User $vendedor)
    {
        $cargos = Cargo::all();
        return view('Proyecto.vendedor.edit',compact('vendedor','cargos'));
    }

    public function update(UpdateRequest $request, User $vendedor)
    {
        if ($request->txtcargo != "Transportista") {
            $rol = Role::select('name')->where('name',$request->txtcargo)->get();
            $xrol = $rol[0]["name"];
            $vendedor->update($request->all());
            if ($request->rol_inicial == "") {
                $vendedor->syncRoles($xrol);
            } else {
                $vendedor->removeRole($request->rol_inicial);
                $vendedor->syncRoles($xrol);
            }
        } else {            
            $vendedor->update($request->all());
            $vendedor->removeRole($request->rol_inicial);
        }
        
        return redirect()->route('vendedor.index')->with('msj','Modificación con éxito!');
    }

    public function inhabilitar($id)
    {
        $vendedor = User::find($id);
        $vendedor->estado = 'INACTIVO';
        $vendedor->password = "";
        $vendedor->save();

        return redirect()->back()->with('msj','Se inhabilitó al usuario!');
    }

    public function habilitar($id)
    {
        $vendedor = User::find($id);
        $vendedor->estado = 'ACTIVO';
        $vendedor->password = bcrypt('password');
        $vendedor->save();

        return redirect()->route('vendedor.index')->with('msj','Empleado habilitado!');
    }
}
