@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Cuentas</h3>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@stop

@section('content')
<section class="container">
    @can('cuenta.create')
        <a href="{{ route('cuenta.create') }}" class="btn btn-outline-primary">Registrar Cuenta</a>    
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
    <div class="header">
        <br>
        @can('cuenta.create')
        <table id="myTable" class="table table-light dt-responsive nowrap text-center" style="width:100%">
            <thead>
                <tr>
                    <th>Nro Cuenta</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    {{-- <th style="text-align: center">Opciones</th> --}}
                </tr>
            </thead>
       
            <tbody>
                @foreach ($cuentas as $cuenta)
                    <tr>  
                        <td>{{$cuenta->id}}</td>
                        <td>{{$cuenta->fecha}}</td>
                        <td>{{$cuenta->total}}</td>
                        {{-- <td style="text-align: center">
                            <form action="{{route('cliente.edit',$cliente)}}" method="get">
                                <button type="submit" style="background: none" class="btn img"> <img src="https://image.flaticon.com/icons/png/512/1632/1632587.png" alt="icono borrar" style="width: 25px; height: 25px;"></button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endcan

        @can('venta.reporte')
        <table id="myTable" class="table table-light dt-responsive nowrap text-center" style="width:100%">
            <thead>
                <tr>
                    <th>Nro Cuenta</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    {{-- <th style="text-align: center">Opciones</th> --}}
                </tr>
            </thead>
       
            <tbody>
                @foreach ($cuentax as $item)
                    <tr>  
                        <td>{{$item->id}}</td>
                        <td>{{$item->fecha}}</td>
                        <td>{{$item->total}}</td>
                        {{-- <td style="text-align: center">
                            <form action="{{route('cliente.edit',$cliente)}}" method="get">
                                <button type="submit" style="background: none" class="btn img"> <img src="https://image.flaticon.com/icons/png/512/1632/1632587.png" alt="icono borrar" style="width: 25px; height: 25px;"></button>
                            </form>
                        </td> --}}
   
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endcan
    </div>
</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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
    }, 6000)
    </script>
        
@stop