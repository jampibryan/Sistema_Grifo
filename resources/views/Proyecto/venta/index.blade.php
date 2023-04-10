@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Ventas</h3>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@stop

@section('content')
<div class="container">
    @can('venta.create')
        <a href="{{ route('venta.create') }}" class="btn btn-outline-primary">Nueva Venta</a>
    @endcan
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
    <section class="container">
        <div class="header">
            <br>
            <table id="myTable"  class="table table-light dt-responsive nowrap text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>Nro venta</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>                        
                        <th style="text-align: center">Detalle</th>
                        <th style="text-align: center">Comprobante</th>
                    </tr>
                </thead>
           
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>  
                            <td>{{$venta->id}}</td>
                            <td>{{$venta->fecha}}</td>
                            <td>{{$venta->total}}</td>
                            <td>{{$venta->estado}}</td>
                            <td style="text-align: center">
                                <a href="{{ route('venta.show', $venta->id) }}" class="btn btn-success"><i class="fas fa-info"></i> Ver</a>                               
                            </td>
                            <td style="text-align: center">
                                <a href="{{ route('ventas.ventapdf', $venta->id) }}" class="btn btn-secondary"><i class="fas fa-file-download"></i></a>                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
               </table>
               <br>
        </div>
        @can('venta.reporte')
            <div class="card-header">
                <form action="{{ route('ventas.imprimir') }}" method="get">
                    <button type="submit" class="btn btn-outline-danger">Reporte de Ventas Diario</button>
                </form>
            </div>
        @endcan

    </section>
</div>
@stop

@section('css')

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    <script>
    console.log('Hi!');

    $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    
    <script>
        $('#myTable').DataTable({
        responsive: true,
        autoWidth: false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontro lo que busca",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
    setTimeout(() => {
        document.querySelector('#alertas').remove()
    }, 4000);
    </script>
@stop