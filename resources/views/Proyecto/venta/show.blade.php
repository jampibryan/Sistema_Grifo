@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <h1>Detalle Venta</h1>
@stop

@section('content')
<div class="container">
    <div id="alertas">
        @if (session('msj'))
            <div class="w-100 alert alert-success alert-dismisible fade show mt-3 d-flex justify-content-between" role="alert">
                {{ session('msj') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header row">
            @foreach ($venta as $item)
                <div class="col-12 text-center">
                    <label for="" class="d-block">Número de Venta</label>
                    <span>{{ $item->id }}</span>
                    <input type="hidden" name="" value="{{ $id = $item->id }}">
                </div>
                <div class="col-md-3 text-center">
                    <label for="" class="d-block">Cliente</label>
                    {{-- <a href="{{ route('clientes.show', $venta->cliente) }}"><span>{{ $venta->cliente->nombre }}</span></a> --}}
                    <span>{{$item->nombre}}</span>
                </div>
                <div class="col-md-3 text-center">
                    <label for="" class="d-block">Vendedor</label>
                    <span>{{ $item->name }} {{ $item->apellidos }}</span>            
                </div>
                <div class="col-md-3 text-center">
                    <label for="" class="d-block">Estado Venta</label>
                    <span>{{ $item->estado }}</span>
                    <input type="hidden" name="" value="{{ $estado = $item->estado }}">
                    <input type="hidden" name="" id="" value="{{ $total = $item->total }}">
                    <input type="hidden" name="" id="" value="{{ $igv = $item->igv }}">
                </div>
                <div class="col-md-3 text-center">
                    <label for="" class="d-block">Tipo de pago</label>
                    <span>{{ $item->descripcionTipoPago }}</span>            
                </div>
            @endforeach
        </div>
        <div class="card-body row">
            <div class="table-responsive">
                <table id="detalles" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio Venta</th>
                            {{-- <th>Descuento</th> --}}
                            <th>Cantidad</th>
                            <th>SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" name="" id="" value="{{ $auxSub = 0; }}">
                        @foreach ($detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->descripcion }}</td>
                                <td>{{ $detalle->precio }}</td>
                                {{-- <td>discount</td> --}}
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ $detalle->subtotal }}</td>                    
                                <input type="hidden" name="" id="" value="{{$auxSub=$auxSub+$detalle->subtotal;}}">
                            </tr>
                        @endforeach
                        <input type="hidden" name="" id="" value="{{ $auxSub; }}">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">
                                <p class="text-right">SUB TOTAL:</p>
                            </th>
                            <th>
                                <p class="text-right"><span>{{ number_format($auxSub, 2) }}</span></p>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3">
                                <p class="text-right">PAGO IGV</p>
                            </th>
                            <th>
                                <p class="text-right"><span>{{ number_format($auxSub * $igv / 100, 2) }}</span></p>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="">
                                <button type="button" class="btn btn-success" onclick="mostrar()">Cambiar Estado</button>
                            </th>
                            <th colspan="2">
                                <p class="text-right">TOTAL PAGAR</p>
                            </th>
                            <th>
                                <p class="text-right"><span>S/ {{ number_format($total, 2) }}</span></p>
                            </th>
                        </tr>
                        <tr id="tr_id">
                            <td>
                                <form action="{{ route('venta.update', $id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    @if ($estado == "EMITIDA")
                                        <div class="form-check">
                                            <input type="radio" name="estado" id="" value="PAGADA" class="form-check-input">
                                            <label class="form-check-label" for="">PAGADA</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    @endif
    
                                    @if ($estado == "PAGADA")
                                        <div class="form-check">
                                            <input type="radio" name="estado" id="" value="ARCHIVADA" class="form-check-input">
                                            <label class="form-check-label" for="">ARCHIVADA</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    @endif
    
                                    @if ($estado == "ARCHIVADA")
                                        <span class="text-danger">No hay estado disponible, se encuentra archivada!</span>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="{{ route('venta.index') }}" class="btn btn-primary">Regresar</a>
        </div> 
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
    <script>
        
        var aux = 0

        document.querySelector('#tr_id').style.display = 'none'

        function mostrar() {
            aux++
            if (aux == 1) {
                document.querySelector('#tr_id').style.display = 'block'
            }
            if(aux > 1) {
                document.querySelector('#tr_id').style.display = 'none'
                aux = 0
            }            
        }

        setTimeout(() => {
            document.querySelector('#alertas').remove()
        }, 4000);
    </script>
@stop