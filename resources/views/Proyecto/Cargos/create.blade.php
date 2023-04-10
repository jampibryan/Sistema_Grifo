@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <div class="card-header"><h3>Registro Cargo</h3></div>
    </div>
@stop

@section('content')
    <form action="{{route('cargo.store')}}" method="post" class="formcreate">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="name">Descripcion</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar descripción" name="descripcion" value="{{ old('descripcion') }}">
                @error('descripcion')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Sueldo</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar stock" name="sueldo" value="{{ old('sueldo') }}">
                @error('sueldo')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>
       
            <div class="card-footer">
                <a type="button" class="btn btn-danger" href="{{ route('cargo.index') }}">Atrás</a>
                <button type="submit" style="float: right" class="btn btn-primary">Guardar</button>
            </div>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.formcreate').submit(function (e) {
            e.preventDefault()
            Swal.fire({
                title: '¿Seguro que desea registrar este cargo?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButton: '#d33',
                confirmButtonText: 'Sí'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit()
                }
            })
        })
    </script>
@stop