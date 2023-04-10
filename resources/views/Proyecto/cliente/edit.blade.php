@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <div class="card-header"><h3>Editar cliente</h3></div>
    </div>
@stop

@section('content')
    <div class="container-fluid col-11 rounded" style="background-color: rgb(255, 255, 255)">
        <form action="{{ route('cliente.update', $cliente->id) }}" method="post" class="formulario">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="row">
                    <div class="col-8 form-group">
                        <label for="name">Nombres</label>
                        <input  type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar nombres" name="nombre" value="{{ old('nombre', $cliente->nombre) }}">
                        @error('nombre')
                            <span class="text-danger">* {{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-4 form-group" >
                        <div class="col">
                            <div class="row">
                                <label for="exampleInputEmail1">Tipo Cliente</label>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <input  type="radio" id="rb_natural" name="tipoCliente" value="NATURAL" {{ (old('tipoCliente', $cliente->tipoCliente) == "NATURAL") ? "checked" : "" }}>
                                </div>

                                <div class="col">
                                    <label for="rb_natural">NATURAL</label>
                                </div>

                                <div class="col-2">
                                    <input  type="radio" id="rb_juridico" name="tipoCliente" value="JURIDICO" {{ (old('tipoCliente', $cliente->tipoCliente) == "JURIDICO") ? "checked" : "" }}>
                                </div>

                                <div class="col">
                                    <label for="rb_juridico">JURIDICO</label>
                                </div>
                            </div>
                            @error('tipoCliente')
                                <span class="text-danger">* {{ $message }}</span>
                            @enderror        
                        </div>
                    </div>                
                </div>
               
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="exampleInputEmail1" id="labelNro">Nro Documento</label>
                        <input  type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingrese Nro documento" name="nroDocumento" value="{{ old('nroDocumento', $cliente->nroDocumento) }}">
                        @error('nroDocumento')
                            <span class="text-danger">* {{ $message }}</span>
                        @enderror 
                    </div>
                    <div class="col-6 form-group">
                        <label for="name">Teléfono</label>
                        <input  type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar teléfono" name="telefono"  value="{{ old('telefono', $cliente->telefono) }}">
                        @error('telefono')
                            <span class="text-danger">* {{ $message }}</span>
                        @enderror 
                    </div>
                </div>

                <div class="row">
                    <div class="col form-group">
                        <label for="exampleInputEmail1">Dirección</label>
                        <input  type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingrese dirección" name="direccion" value="{{ old('direccion', $cliente->direccion) }}">
                        @error('direccion')
                            <span class="text-danger">* {{ $message }}</span>
                        @enderror
                    </div> 
                    <div class="col form-group">
                        <label for="exampleInputEmail1">Correo electrónico</label>
                        <input  type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingrese email" name="email" value="{{ old('email', $cliente->email) }}">
                        @error('email')
                            <span class="text-danger">* {{ $message }}</span>
                        @enderror
                    </div>                    
                </div>
                <div>
                    <a type="button" class="btn btn-danger" href="{{ route('cliente.index') }}">Atrás</a>
                    <button type="submit" style="float: right" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            verSeleccion()
            console.log('hola');
        })

        function verSeleccion() {
            if (document.getElementById('rb_natural').checked == true) {
                // document.getElementById('labelNro').innerHTML = 'DNI'
                console.log('ap');
            }
            else if (document.getElementById('rb_juridico').checked == true) {
                // document.querySelector('#labelNro').innerHTML = 'RUC'
                console.log('ruc');
            }
        }

        $('.formulario').submit(function (e) {
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