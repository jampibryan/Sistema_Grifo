@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <a href="{{ route('compra.index') }}" class="btn btn-outline-success mt-4 mb-3"><i class="fas fa-arrow-left"></i> Regresar</a>
    <div id="alertas">
        @if (session('msj'))
            <div class="w-100 alert alert-success alert-dismisible fade show mt-3 d-flex justify-content-between" role="alert">
                {{ session('msj') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('merror'))
            <div class="w-100 alert alert-warning alert-dismisible fade show mt-3 d-flex justify-content-between" role="alert">
                {{ session('merror') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header row">
            @foreach ($compra as $item)
                <div class="col-6 text-center">
                    <label for="" class="d-block">Número de Compra</label>
                    <span>{{ $item->id }}</span>
                    <input type="hidden" name="" value="{{ $id = $item->id }}">
                </div>
                <div class="col-6 text-center">
                    <label for="" class="d-block">Proveedor</label>
                    {{-- <a href="{{ route('clientes.show', $venta->cliente) }}"><span>{{ $venta->cliente->nombre }}</span></a> --}}
                    <span>{{$item->nombre}}</span>
                </div>
                <div class="col-md-3 text-center">
                    <label for="" class="d-block">Empleado</label>
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
            <div class="card-body">
                <div class="row mb-2 d-flex">
                    <button class="btn btn-primary col" onclick="cambio()" style="display: inline-block">Cambiar Estado</button>
                    @if ($estado == "EMITIDA")
                        <button class="btn btn-primary col" onclick="cfecha()">Cambiar Fecha Entrega</button>
                    @endif
                </div>

                <div id="form-estado" class="w-50">

                    @if ($estado == "EMITIDA" or $estado == "RECIBIDA")
                        <div class="">
                            <a href="{{ route('compra.registro', $id) }}" class="text-success">Registrar cantidades recibidas <i class="fas fa-external-link-alt"></i></a>
                        </div>
                    @endif

                    <form action="{{ route('compra.update', $id) }}" method="post">
                        @csrf
                        @method('put')

                        @if ($estado == "RECIBIDA")
                            <div class="form-check">
                                <input type="radio" name="estado" id="" value="PAGADA" class="form-check-input"
                                    @if ($estado == "PAGADA")
                                        checked
                                    @endif
                                >
                                <label class="form-check-label" for="">PAGADA</label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-1">Guardar</button>
                        @endif

                        @if ($estado == "PAGADA")
                            <div class="form-check">
                                <input type="radio" name="estado" id="" value="ARCHIVADA" class="form-check-input"
                                    @if ($estado == "ARCHIVADA")
                                        checked
                                    @endif
                                >
                                <label class="form-check-label" for="">ARCHIVADA</label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-1">Guardar</button>
                        @endif
                        
                        @if ($estado == "ARCHIVADA")
                            <div class="text-center">
                                <span class="text-danger">
                                    No hay estado, ya está archivada!!
                                </span>
                            </div>
                        @endif
                    </form>
                </div>
                <div id="form-fecha" class="w-50" style="margin-left: 50%">
                    <form action="{{ route('cambioFecha', $id) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="date" name="newFecha" id="" class="form-control mb-1">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
    <script>
        setTimeout(() => {
            document.querySelector('#alertas').remove()
        }, 6000);

        var presiona = 0
        var presiona2 = 0

        document.querySelector('#form-estado').style.display = 'none'
        document.querySelector('#form-fecha').style.display = 'none'

        console.log(uno);
        function cambio() {
            presiona++
            if (presiona == 1) {
                document.querySelector('#form-fecha').style.display = 'none'
                document.querySelector('#form-estado').style.display = 'inline-block'
            }
            if (presiona > 1) {
                document.querySelector('#form-estado').style.display = 'none'
                presiona = 0                
            }
        }

        function cfecha() {            
            presiona2++
            if (presiona2 == 1) {
                document.querySelector('#form-fecha').style.display = 'inline-block'
                document.querySelector('#form-estado').style.display = 'none'
            }
            if (presiona2 > 1) {
                document.querySelector('#form-fecha').style.display = 'none'
                presiona2 = 0
            }
        }
    
    </script>
@stop