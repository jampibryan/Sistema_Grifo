@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Detalle Compra</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header row">
        @foreach ($compra as $item)
            <div class="col-4 text-center">
                <label for="" class="d-block">Número de Compra</label>
                <span>{{ $item->id }}</span>
                <input type="hidden" name="" value="{{ $id = $item->id }}">
            </div>
            <div class="col-4 text-center">
                <label for="" class="d-block">Proveedor</label>
                {{-- <a href="{{ route('clientes.show', $venta->cliente) }}"><span>{{ $venta->cliente->nombre }}</span></a> --}}
                <span>{{$item->nombre}}</span>
            </div>
            @foreach ($transportista as $tr)
                <div class="col-4 text-center">
                    <label for="" class="d-block">Transportista</label>
                    <span>{{ $tr->name }} {{ $tr->apellidos }}</span>
                </div>
            @endforeach
            <div class="col-md-3 text-center">
                <label for="" class="d-block">Realizó orden compra</label>
                <span>{{ $item->name }} {{ $item->apellidos }}</span>            
            </div>
            <div class="col-md-3 text-center">
                <label for="" class="d-block">Estado orden compra</label>
                <span>{{ $item->estado }}</span>
                <input type="hidden" name="" value="{{ $estado = $item->estado }}">
                <input type="hidden" name="" id="" value="{{ $total = $item->total }}">
                <input type="hidden" name="" id="" value="{{ $igv = $item->igv }}">
            </div>
            <div class="col-md-3 text-center">
                <label for="" class="d-block">Fecha Emision</label>
                <span>{{ $item->fechaEmision }}</span>
            </div>
            <div class="col-md-3 text-center">
                <label for="" class="d-block">Fecha Entrega</label>
                <span>{{ $item->fechaEntrega }}</span>
            </div>
        @endforeach
    </div>
    <div class="card-body row">
        <form action="{{ route('compra.entrega', $id) }}" class="w-100" method="POST">
            @csrf
            @method('put')
            <div class="table-responsive">
                <table id="detalles" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad Solicitada</th>
                            <th>Cantidad Recibida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" name="" id="" value="{{ $auxSub = 0; }}">
                        @foreach ($detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->descripcion }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td><input type="hidden" name="producto_id[]" id="" value="{{ $detalle->id }}">
                                    <input type="text" class="form-control w-50 ele" name="cantidad_entrega[]" value="{{ $detalle->cantidad_recibida }}">
                                </td>
                                <input type="hidden" name="" id="" value="{{$auxSub=$auxSub+$detalle->subtotal;}}">
                            </tr>
                        @endforeach
                        <input type="hidden" name="" id="" value="{{ $auxSub; }}">
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-success">Guardar cambios</button>
        </form>
    </div>
    <div class="card-footer text-right">
        <a href="{{ route('compra.index') }}" class="btn btn-primary">Regresar</a>
    </div> 
</div>
@stop

@section('css')

@stop

@section('js')
    <script>
    </script>
@stop