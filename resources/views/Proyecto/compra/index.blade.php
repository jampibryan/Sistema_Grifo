@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Compras</h3>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@stop

@section('content')
<div class="container">
    @can('compra.create')
        <a href="{{ route('compra.create') }}" class="btn btn-outline-primary">Nueva compra</a>
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
                        <th>Nro compra</th>
                        <th>Fecha Emision</th>
                        <th>Total</th>
                        <th>Estado</th>                        
                        <th style="text-align: center">Opciones</th>
                    </tr>
                </thead>
           
                <tbody>
                    @foreach ($compras as $compra)
                        <tr>  
                            <td>{{$compra->id}}</td>
                            <td>{{$compra->fecha}}</td>
                            <td>{{$compra->total}}</td>
                            <td>{{$compra->estado}}</td>
                            <td style="text-align: center">
                                <a href="{{ route('compra.show', $compra->id) }}" class="btn btn-secondary"><i class="fas fa-info"></i> Detalle</a>
                                @can('compra.edit')
                                    {{-- <a href="{{ route('compra.edit', $compra->id) }}" class="btn btn-success"><i class="fas fa-pen"></i> Editar</a> --}}
                                    <form action="{{ route('compra.edit', $compra->id) }}" method="get" class="formedit d-inline">
                                        <button class="btn btn-success" type="submit"><i class="fas fa-pen"></i>Editar</button>
                                    </form>
                                @endcan
                                @can('compra.reporte')
                                    <a href="{{ route('compra.reporteCF', $compra->id) }}" class="btn btn-primary"><i class="fas fa-file-pdf"></i> Reporte</a>
                                @endcan
                            </td>
       
                        </tr>
                    @endforeach
                </tbody>
               </table>
               <br>
        </div>
    </section>
</div>
@stop

@section('css')

@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    }, 6000);

    $('.formedit').submit(function (e) {
            e.preventDefault()
            Swal.fire({
                title: '¿Seguro que desea editar esta compra?',
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