@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Empleados Inhabilitados</h3>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@stop

@section('content')    
    <section class="container">
        <a href="{{ route('vendedor.index') }}" class="btn btn-outline-primary">Regresar</a>
        @can('usuario.index')
            <form action="{{ route('vendedor.index2') }}" method="get" class="d-inline">
                <button type="submit" class="btn btn-outline-success">Ver Empleados Inhabilitados</button>
            </form>
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
            <table id="myTable"  class="table table-light dt-responsive nowrap text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        @can('usuario.index')
                            <th style="text-align: center">Habilitar</th>
                        @endcan
                    </tr>
                </thead>
           
                <tbody>
                    @foreach ($vendedores as $v)
                        <tr>  
                            <td>{{$v->id}}</td>
                            <td>{{$v->name}}</td>
                            <td class="col-2">{{$v->apellidos}}</td>
                            <td class="col-2">{{$v->dni}}</td>
                            @can('usuario.edit')
                                <td style="text-align: center">
                                    <form action="{{route('vendeddor.habilitar',$v->id)}}" method="get" class="formhabilitar">
                                        <button type="submit"  class="btn img"><img src="https://thumbs.dreamstime.com/b/s%C3%ADmbolo-de-icono-edici%C3%B3n-vectorial-texto-o-documento-ilustraci%C3%B3n-aislada-en-el-fondo-223608879.jpg" alt="icono borrar" style="width: 30px; height: 30px;"></button>
                                    </form>        
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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

    $('.formhabilitar').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Seguro que desea habilitar a este empleado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',                
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
        });
    </script>
@stop