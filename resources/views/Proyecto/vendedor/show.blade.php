@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>Empleado</h2>
    <style>
        #div1{
            font-family: 'Courier New', Courier, monospace;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="row" style="margin-left: 7%;">
            <div id="div1" class="col-6">
                <div>Nombres: </div>
                <div>Apellidos:</div>
                <div>DNI: </div>
                <div>Teléfono:</div>
            </div>

            <div class="col-6">
                <span>{{$vendedor->name}}</span><br>
                <span>{{$vendedor->apellidos}}</span>
                <span>{{$vendedor->dni}}</span><br>
                <span>{{$vendedor->telefono}}</span>
            </div>
        </div>

        <div class="row" style="margin-left: 7%;">
            <div id="div1" class="col-6">
                <div>Direccion: </div>
                <div>Genero:</div>
                <div>Nacimiento: </div>
                <div>Email:</div>
            </div>

            <div class="col-6">
                <div>{{$vendedor->direccion}}</div>
                <div>{{$vendedor->genero}}</div>
                <div>{{$vendedor->fechanacimiento}}</div>
                <div>{{$vendedor->email}}</div>
            </div>
        </div>
    </div>
    <div class="row" style="align-items: center;margin-left: 10%; text-align: center">
        @if ($vendedor->estado == "ACTIVO")
            <div class="col-6">
                <h5>Estado: ACTIVO </h5>
            </div>
        @else
            <div class="col-6">
                <h5>Estado: INACTIVO </h5>
            </div>
        @endif
        <br>
        @foreach ($vendedor->roles as $item)
            <div class="col-6">
                <h5>Cargo: {{ $item->name }}</h5>
            </div>
        @endforeach
    </div>
    <div class="row mt-3">
        <div class="container">
            <div class="col-12">
                <a href="{{ route('vendedor.index') }}" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop