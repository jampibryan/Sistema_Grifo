@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <div class="card-header"><h3>Cargos</h3></div>
    </div>
@stop

@section('content')
    <div class="card-header">Editar datos del Cargo</div>
    <form action="{{route('cargo.update',$cargos->id)}}" method="post" class="formupdate">
        @csrf
        {{method_field('PUT')}}

        <div class="card-body">
              <div class="form-group">
                <label for="name">Descripcion</label>
                <input required type="text" value="{{old('descripcion',$cargos->descripcioncargo)}}" class="form-control" id="descripcion" placeholder="Ingresar descripción" name="descripcion">
                @error('descripcion')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Sueldo</label>
                <input required type="text" value="{{$cargos->sueldo}}" class="form-control" id="sueldo" placeholder="Ingresar cantidad" name="sueldo">
                @error('sueldo')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>
                         
            <div class="card-footer">
                <button type="submit" style="float: right" class="btn btn-primary">Guardar</button>
                <a type="button" class="btn btn-danger" href="{{ route('cargo.index') }}">Atrás</a>
            </div>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.formupdate').submit(function (e) {
            e.preventDefault()
            Swal.fire({
                title: '¿Seguro que desea guardar cambios?',
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