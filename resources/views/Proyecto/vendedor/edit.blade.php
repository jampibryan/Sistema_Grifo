@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Editar datos de Empleado</h3>
@stop

@section('content')
    <div class="container-fluid col-11 rounded" style="background-color: rgb(255, 255, 255)">
        <form action="{{route('vendedor.update',$vendedor->id)}}" method="post" class="formulario">
            @csrf
            @method('put')
            @foreach ($vendedor->roles as $item)
                <input type="hidden" value="{{ $item->name }}" name="rol_inicial">
            @endforeach

            <div class="card-body">
                <div class="row">
                    <div class="col form-group">
                        <label for="name">Nombres</label>
                        <input value="{{ old('name', $vendedor->name) }}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar nombres" name="name">
                        @error('name')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror                        
                      </div>
          
                      <div class="col form-group">
                          <label for="name">Apellidos</label>
                          <input value="{{ old('apellidos', $vendedor->apellidos) }}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar apellidos" name="apellidos">
                          @error('apellidos')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                      </div>
                </div>
               
                <div class="row">
                    <div class="col-3 form-group">
                        <label for="name">Teléfono</label>
                        <input value="{{ old('telefono', $vendedor->telefono) }}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar teléfono" name="telefono">
                        @error('telefono')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
        
                    <div class="col-3 form-group">
                        <label for="exampleInputEmail1">DNI</label>
                        <input value="{{ old('dni', $vendedor->dni) }}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingrese email" name="dni">
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
                                        <input type="radio" id="contactChoice1" name="genero" value="M"
                                            {{ (old('genero', $vendedor->genero) == "M") ? "checked" : "" }}
                                        >
                                    </div>
    
                                    <div class="col">
                                        <label for="contactChoice1">M</label>
                                    </div>
    
                                    <div class="col-2">
                                        <input type="radio" id="contactChoice2" name="genero" value="F"
                                            {{ (old('genero', $vendedor->genero) == "F") ? "checked" : "" }}
                                        >
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
                        <input value="{{ $vendedor->fechanacimiento }}" type="date" class="form-control" id="exampleInputEmail1" placeholder="Ingrese email" name="fechanacimiento">
                        @error('fechanacimiento')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col form-group">
                        <label for="exampleInputEmail1">Dirección</label>
                        <input value="{{ old('direccion', $vendedor->direccion) }}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingrese email" name="direccion">
                        @error('direccion')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div> 
                    <div class="col form-group">
                        <label for="exampleInputEmail1">Correo electrónico</label>
                        <input value="{{ old('email', $vendedor->email) }}" type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingrese email" name="email">
                        @error('email')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                </div>
               
                <div class="col form-group">
                    <label for="exampleInputEmail1">Cargo</label>
                    <select class="form-control" name="cargo_id" id="cargo" onchange="mostrar()">
                        @foreach ($cargos as $item)
                            <option 
                            @if (old('cargo_id',$vendedor->cargo_id) == $item->id)
                                selected
                            @endif 
                            value="{{$item->id}}">{{$item->descripcioncargo}}
                        </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="txtcargo" value="" id="nombrecargo">
                    @error('cargo_id')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
    
                <div>
                    <a type="button" class="btn btn-danger" href="{{ route('vendedor.index') }}">Atrás</a>
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

        document.addEventListener("DOMContentLoaded", function () {
            mostrar()
        })

        function mostrar() {
            cbx = document.querySelector('#cargo')
            xcargo = cbx.options[cbx.selectedIndex].text
            document.querySelector('#nombrecargo'). value = xcargo
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