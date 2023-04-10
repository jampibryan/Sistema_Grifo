@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <div class="card-header"><h3>Registro Proveedor</h3></div>
    </div>
@stop

@section('content')
    <form action="{{route('proveedores.store')}}" method="post">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="name">RUC</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar RUC" name="RUC" value="{{ old('RUC') }}">
                @error('RUC')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Nombre" name="nombre" value="{{ old('nombre') }}">
                @error('nombre')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Email" name="email" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Direccion</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Direccion" name="direccion" value="{{ old('direccion') }}">
                @error('direccion')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Telefono</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Telefono" name="telefono" value="{{ old('telefono') }}">
                @error('telefono')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>
       
            <div class="card-footer">
                <a type="button" class="btn btn-danger" href="{{ route('proveedores.index') }}">Atrás</a>
                <button type="submit" style="float: right" class="btn btn-primary">Guardar</button>
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