@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <div class="card-header"><h3>Producto</h3></div>
    </div>
@stop

@section('content')
    <div class="card-header">Editar datos del producto</div>
    <form action="{{route('producto.update',$producto->id)}}" method="post" class="formupdate">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Categoria</label>
                <select class="form-control" name="categoria_id" id="">
                    @foreach ($categorias as $item)
                    <option value="{{$item->id}}"
                       @if (old('categoria_id', $producto->categoria_id) == $item->id)
                           selected
                       @endif
                        >
                        {{$item->descripcion}}
                    </option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="name">Descripcion</label>
                <input type="text" value="{{ old('descripcion', $producto->descripcion) }}" class="form-control" id="exampleInputEmail1" placeholder="Ingresar descripción" name="descripcion">
                @error('descripcion')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Cantidad</label>
                <input type="text" value="{{ old('cantidad', $producto->cantidad) }}" class="form-control" id="exampleInputEmail1" placeholder="Ingresar cantidad" name="cantidad">
                @error('cantidad')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Precio</label>
                <input type="text" value="{{ old('precio', $producto->precio) }}" class="form-control" id="exampleInputEmail1" placeholder="Ingresar precio" name="precio">
                @error('precio')
                    <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>            
            <div class="card-footer">
                <button type="submit" style="float: right" class="btn btn-primary">Guardar</button>
                <a type="button" class="btn btn-danger" href="{{ route('producto.index') }}">Atrás</a>
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