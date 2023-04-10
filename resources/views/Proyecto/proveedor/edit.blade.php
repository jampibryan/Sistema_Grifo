@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <div class="card-header"><h3>Proveedores</h3></div>
    </div>
@stop

@section('content')
    <div class="card-header">Editar datos del Proveedor</div>
    <form action="{{route('proveedores.update',$proveedores->id)}}" method="post">
        @csrf
        {{method_field('PUT')}}

        <div class="card-body">

            <div class="form-group">
                <label for="name">RUC</label>
                <input type="text" value="{{$proveedores->RUC}}" class="form-control" id="exampleInputEmail1" placeholder="Ingresar RUC" name="RUC" value="{{ old('RUC') }}">
            </div>

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" value="{{$proveedores->nombre}}" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Nombre" name="nombre" value="{{ old('nombre') }}">
            </div>

            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" value="{{$proveedores->email}}" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="name">Direccion</label>
                <input type="text" value="{{$proveedores->direccion}}" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Direccion" name="direccion" value="{{ old('direccion') }}">
            </div>

            <div class="form-group">
                <label for="name">Telefono</label>
                <input type="text" value="{{$proveedores->telefono}}" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Telefono" name="telefono" value="{{ old('telefono') }}">
            </div>

            <div class="card-footer">
                <button type="submit" style="float: right" class="btn btn-primary">Actualizar</button>
                <a type="button" class="btn btn-danger" href="{{ route('proveedores.index') }}">Atrás</a>

            </div>
        </div>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop