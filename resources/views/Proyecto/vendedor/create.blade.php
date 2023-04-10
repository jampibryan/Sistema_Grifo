@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Registrar vendedor</h3>
    <hr>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <form class="form" action="{{route('vendedor.store')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col form-group">
                            <label for="validationCustom01">Nombres</label>
                            <input for="validationCustom01" type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar nombres" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
            
                        <div class="col form-group">
                            <label for="name">Apellidos</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar apellidos" name="apellidos" value="{{ old('apellidos') }}">
                            @error('apellidos')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-3 form-group">
                            <label for="name">Teléfono</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar teléfono" name="telefono" value="{{ old('telefono') }}">
                            @error('telefono')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
            
                        <div class="col-3 form-group">
                            <label for="exampleInputEmail1">DNI</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingrese email" name="dni" value="{{ old('dni') }}">
                            @error('dni')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
        
                        <div class="col-3 form-group" >
                            <div class="col">
                                <div class="row">
                                    <label for="exampleInputEmail1">Género</label>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <input type="radio" id="contactChoice1" name="genero" value="M" {{ (old('genero') == "M") ?  "checked" : "" }}>
                                    </div>

                                    <div class="col">
                                        <label for="contactChoice1">M</label>
                                    </div>

                                    <div class="col-2">
                                        <input type="radio" id="contactChoice2" name="genero" value="F" {{ (old('genero') == "F") ?  "checked" : "" }}>
                                    </div>

                                    <div class="col">
                                        <label for="contactChoice2">F</label>
                                    </div>
                                </div>         
                            </div>
                            @error('genero')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>    
        
                        <div class="col-3 form-group">
                            <label for="exampleInputEmail1">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Ingrese email" name="fechanacimiento" value="{{ old('fechanacimiento') }}">
                            @error('fechanacimiento')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Dirección</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingrese dirección" name="direccion" value="{{ old('direccion') }}">
                            @error('direccion')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div> 
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Correo electrónico</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingrese email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Cargo</label>
                            <select class="form-control" name="cargo_id" id="cargo" onchange="aCargo()">
                                <option value="" disabled selected>-- Seleccione cargo --</option>
                                @foreach ($cargos as $item)
                                    <option value="{{$item->id}}" {{ (old('cargo_id') == $item->id) ? 'selected' : '' }} >{{$item->descripcioncargo}}</option>
                                @endforeach
                                <input type="hidden" name="txtcargo" id="txtcargo">
                            </select>
                            @error('cargo_id')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>    
                    <div>
                        <a type="button" class="btn btn-danger" href="{{ route('vendedor.index') }}">Atrás</a>
                        <button type="submit" style="float: right" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function aCargo() {
            cbx = document.querySelector('#cargo')
            xcargo = cbx.options[cbx.selectedIndex].text
            console.log(xcargo);
            document.querySelector('#txtcargo').value = xcargo
        }

        $('.form').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Seguro que desea guardar este empleado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',                
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
        })
    </script>
@stop