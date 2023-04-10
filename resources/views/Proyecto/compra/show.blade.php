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
        <div class="table-responsive">
            <table id="detalles" class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio Compra</th>                        
                        <th>Cantidad pedido</th>
                        <th>Cantidad recibida</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" name="" id="" value="{{ $auxSub = 0; }}">
                    @foreach ($detalles as $detalle)
                        <tr 
                            @if ($detalle->cantidad > $detalle->cantidad_recibida and ($estado == "RECIBIDA" or $estado == "PAGADA" or $estado == "ARCHIVADA"))
                                class="bg-danger text-white"
                            @else
                                class=""
                            @endif
                        >
                            <td>{{ $detalle->descripcion }}</td>
                            <td>{{ $detalle->precio }}</td>                            
                            <td>{{ $detalle->cantidad }}</td>
                            <td>
                                @if ($estado == "EMITIDA")
                                    No registra
                                @else
                                    {{ $detalle->cantidad_recibida }}
                                @endif
                            </td>
                            <td>{{ $detalle->subtotal }}</td>                    
                            <input type="hidden" name="" id="" value="{{$auxSub=$auxSub+$detalle->subtotal;}}">
                        </tr>
                    @endforeach
                    <input type="hidden" name="" id="" value="{{ $auxSub; }}">
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">
                            <p class="text-right">SUB TOTAL:</p>
                        </th>
                        <th>
                            <p class="text-right"><span>{{ number_format($auxSub, 2) }}</span></p>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <p class="text-right">PAGO IGV</p>
                        </th>
                        <th>
                            <p class="text-right"><span>{{ number_format($auxSub * $igv / 100, 2) }}</span></p>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <p class="text-right">TOTAL PAGAR</p>
                        </th>
                        <th>
                            <p class="text-right"><span>S/ {{ number_format($total, 2) }}</span></p>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card-footer text-right">
        <a href="{{ route('compra.index') }}" class="btn btn-primary">Regresar</a>
    </div> 
</div>
@stop

@section('css')

@stop

@section('js')

@stop