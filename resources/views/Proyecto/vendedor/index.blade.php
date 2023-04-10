@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Empleados</h3>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@stop

@section('content')    
    <section class="container">
        <div>
            @can('usuario.create')
                <a href="{{route('vendedor.create')}}" class="btn btn-outline-primary">Registrar nuevo</a>
            @endcan
            @can('usuario.index')
                <a href="{{ route('vendedor.index2') }}" class="btn btn-outline-success">Ver Empleados Inhabilitados</a>
            @endcan
        </div>
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
                        <th>Teléfono</th>
                        <th>Correo electrónico</th>
                        <th>Cargo</th>
                        @can('usuario.index')
                            <th style="text-align: center">I/H</th>
                        @endcan
                        @can('usuario.edit')
                            <th  style="text-align: center">Editar</th>
                        @endcan
                        @can('usuario.detalle')
                            <th  style="text-align: center">Detalles</th>
                        @endcan
                    </tr>
                </thead>
           
                <tbody>
                    @foreach ($vendedores as $v)
                        @if ($v->estado=="ACTIVO")
                            @if ($v->id != $auxvend)
                                <tr>  
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td class="col-2">{{$v->apellidos}}</td>
                                    <td>{{$v->telefono}}</td>
                                    <td>{{$v->email}}</td>
                                    <td>{{$v->descripcioncargo}}</td> 
                                    @can('usuario.index')
                                        <td style="text-align: center">
                                            <form action="{{route('inhabilitar',$v->id)}}" method="get" class="forminhabilitar">                             
                                                <button type="submit" style="background: none" class="btn img">
                                                    @if ($v->estado =="ACTIVO")
                                                    {{-- <img src="https://image.flaticon.com/icons/png/512/2150/2150538.png" alt="icono borrar" style="width: 30px; height: 30px;"> --}}
                                                    <img src="https://thumbs.dreamstime.com/b/s%C3%ADmbolo-de-icono-edici%C3%B3n-vectorial-texto-o-documento-ilustraci%C3%B3n-aislada-en-el-fondo-223608879.jpg" alt="icono borrar" style="width: 30px; height: 30px;">
                                                    @else
                                                    {{-- <img src="https://image.flaticon.com/icons/png/512/2150/2150374.png" alt="icono borrar" style="width: 30px; height: 30px;"> --}}
                                                    <img src="https://thumbs.dreamstime.com/b/s%C3%ADmbolo-de-icono-edici%C3%B3n-vectorial-texto-o-documento-ilustraci%C3%B3n-aislada-en-el-fondo-223608879.jpg" alt="icono borrar" style="width: 30px; height: 30px;">
                                                    @endif
                                                </button>
                                            </form>
                                        </td>
                                    @endcan

                                    @can('usuario.edit')
                                        <td style="text-align: center">
                                            <form action="{{route('vendedor.edit',$v->id)}}" method="get" class="formedit">
                                                <button type="submit"  class="btn img"> <img src="https://thumbs.dreamstime.com/b/s%C3%ADmbolo-de-icono-edici%C3%B3n-vectorial-texto-o-documento-ilustraci%C3%B3n-aislada-en-el-fondo-223608879.jpg" alt="icono borrar" style="width: 25px; height: 25px;"></button>
                                            </form>        
                                        </td>
                                    @endcan

                                    @can('usuario.detalle')
                                        <td style="text-align: center">
                                            <form action="{{route('vendedor.show',$v->id)}}" method="get">
                                                <button type="submit" class="btn img"> <img src="data:image/png;base64,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" alt="icono borrar" style="width: 25px; height: 25px;"></button>
                                            </form>          
                                        </td>
                                    @endcan
                                </tr>
                            @endif                           
                        @endif
                    @endforeach
                </tbody>
               </table>
               <br>
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

    $('.forminhabilitar').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Seguro que desea inhabilitar a este empleado?',
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
    $('.formedit').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Seguro que desea editar a este empleado?',
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