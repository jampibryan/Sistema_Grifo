@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <div class="card-header"><h3>Categorías</h3></div>
    </div>
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
        @if (session('merror'))
            <div class="w-100 alert alert-danger alert-dismisible fade show mt-3 d-flex justify-content-between" role="alert">
                {{ session('merror') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
</div>
    <div class="container">
        <section class="col-lg-5 connectedSortable" style="cursor: pointer;">
            <div class="card bg-gradient-white collapsed-card" >
              <div class="card-header border-0" data-card-widget="collapse">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Nueva categoria
                </h3>
            </div>
            <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <form action="{{ route('categoria.store') }}" method="POST">
                    @csrf
                    <div class="row col">
                        <div class="col-9">
                            <input name="descripcion" placeholder="Descripción" type="text" id="form7Example1" class="form-control" />
                        </div>
                        <div class="col"><button class=" form-control btn btn-primary" type="submit">Guardar</button></div>
                       

                        {{-- @if($errors->any())
                                <script>
                                    toastr["success"]("Registrado correctamente", "Categoria")
                            
                                    toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-bottom-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "3000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                    }
                                </script>                      
                            @endif --}}
                    </div>
                    </form>
                </div>
            </div>
          </section>
    </div>

    <hr>
    <section class="container">
        <div class="header">
            <br>
            <table id="myTable"  class="table table-light dt-responsive nowrap text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th style="text-align: center">Editar</th>
                        <th style="text-align: center">Eliminar</th>
                    </tr>
                </thead>
           
                <tbody>
                    @foreach ($categorias as $c)
                    
                        <tr>  
                            <td>{{$c->id}}</td>
                            <td style="text-align: center;">
                                <form action="{{route('categoria.update',$c->id)}}" method="post">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <input id="imputeditar{{$contador}}" name="descripcion" disabled style="border: 0; background: transparent; text-align: center" type="text" value="{{$c->descripcion}}">
                                    <button id="guardaredicion{{$contador}}" type="submit" hidden href="" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                                    <button type="button" id="cancelaredicion{{$contador}}" onclick="ocultar({{$contador}})" class="btn btn-secondary btn-sm" hidden><i class="fas fa-window-close"></i></button>
                                </form>
                            </td>
                            
                            <td style="text-align: center">
                                <button type="button" style="background: none" onclick="mostrar({{$contador}},{{$bol}})" class="btn img"> <img src="https://image.flaticon.com/icons/png/512/1632/1632587.png" alt="icono borrar" style="width: 25px; height: 25px;"></button>
                            </td>

                            <td style="text-align: center">
                                <form action="{{route('categoria.destroy',$c->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" style="background: none" class="btn img"> <img src="https://cdn-icons-png.flaticon.com/512/1632/1632602.png" alt="icono borrar" style="width: 25px; height: 25px;"></button>
                                </form>        
                            </td>
                            <label hidden>{{$contador++}}</label>
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
    </script>
    <script>
        function mostrar(row,bol){
           if (bol==true) {
                document.querySelector("#guardaredicion"+row).removeAttribute("hidden");
                document.querySelector("#cancelaredicion"+row).removeAttribute("hidden"); 
                var input = document.querySelector("#imputeditar"+row); 
                input.removeAttribute("disabled"); 
                input.focus();
                $bol=false;
           }
        }
        function ocultar(row){
            
            document.querySelector("#imputeditar"+row).setAttribute("disabled", "");
            document.querySelector("#guardaredicion"+row).hidden = true;
            document.querySelector("#cancelaredicion"+row).hidden = true;
        }

        setTimeout(() => {
            document.querySelector('#alertas').remove()
        }, 6000);
    </script>
        
@stop