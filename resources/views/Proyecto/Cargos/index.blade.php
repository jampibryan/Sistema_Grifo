@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Cargos</h3>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <!-- JQuery Primero -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Toastr.js Después -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@stop

@section('content')
    <section class="container">
        <form action="{{Route('cargo.create')}}" method="get">
            <button type="submit" class="btn btn-outline-primary">Registrar nuevo Cargo</button>
        </form>
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
                        <th>Descripción</th>
                        <th>Sueldo</th>
                        <th style="text-align: center">Editar</th>
                        {{-- <th style="text-align: center">Eliminar</th> --}}
                      </tr>
                </thead>
           
                <tbody>
                    @foreach ($cargos as $c)
                        <tr>  
                            <td>{{$c->id}}</td>
                            <td>{{$c->descripcioncargo}}</td>
                            <td>{{$c->sueldo}}</td>

                            <td style="text-align: center">
                                <form action="{{route('cargo.edit',$c->id)}}" method="get" class="formedit">
                                    @csrf
                                    <button type="submit" style="background: none" class="btn img"> <img src="https://thumbs.dreamstime.com/b/s%C3%ADmbolo-de-icono-edici%C3%B3n-vectorial-texto-o-documento-ilustraci%C3%B3n-aislada-en-el-fondo-223608879.jpg" alt="icono borrar" style="width: 25px; height: 25px;"></button>
                                </form>        
                            </td>

                        </tr>
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

    $('.formedit').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Seguro que desea editar este cargo?',
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
    $('.formdelete').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Seguro que desea eliminar este cargo?',
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