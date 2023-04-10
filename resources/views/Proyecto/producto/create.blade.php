@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <div class="card-header"><h3>Producto</h3></div>
    </div>
@stop

@section('content')
    <div class="card-header">Registrar nuevo producto</div>
    <form action="{{route('producto.store')}}" method="post" class="formenviar">
        @csrf
        <div class="card-body">
            <div class="form-group">
              <label for="name">Categoria</label>
              <select class="form-control" name="categoria_id" id="">
                  <option value="" selected disabled>-- Seleccione Categoria --</option>
                  @foreach ($categorias as $item)
                    <option value="{{$item->id}}" {{ (old('categoria_id') == $item->id) ? "selected" : "" }}>{{$item->descripcion}}</option>
                  @endforeach
              </select>
              @error('categoria_id')
                  <span class="text-danger">* {{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
                <label for="name">Descripcion</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar descripción" name="descripcion" value="{{ old('descripcion') }}">
                @error('descripcion')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Cantidad</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar stock" name="cantidad" value="{{ old('cantidad') }}">
                @error('cantidad')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Precio</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar precio" name="precio" value="{{ old('precio') }}">
                @error('precio')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Unidad de Medida</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Unidad de medida" name="unidaddemedida" value="{{ old('unidaddemedida') }}">
                @error('unidaddemedida')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="form-group">
                <label for="name">Proveedor</label>
                <select class="form-control" name="proveedor" id="">
                    @foreach ($proveedores as $proveedor)
                        <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                    @endforeach
                </select>
              </div> --}}
            
            <div class="card-footer">
                <a type="button" class="btn btn-danger" href="{{ route('producto.index') }}">Atrás</a>
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
        $('.formenviar').submit(function (e) {
            e.preventDefault()
            Swal.fire({
                title: '¿Seguro que desea guardar este producto?',
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