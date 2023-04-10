@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <div class="card-header"><h3>Contactos</h3></div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@stop

@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body pb-0">
        <div class="row d-flex align-items-stretch">

          

          @foreach ($users as $u)
          @if ($u->estado=="ACTIVO")
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
            <div class="card bg-light">
              <div class="card-header text-muted border-bottom-0">
              @if ($u->id ==1)
                    Administrador           
              @else
                    Vendedor
              @endif
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b>{{$u->name}} {{$u->apellidos}}</b></h2>
                    <p class="text-muted text-sm"><b>Info: </b> Edad... / Sexo: {{$u->genero}} / DNI: {{$u->dni}} </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dirección: {{$u->direccion}}</li> <br>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono móvil <br> #: +51 {{$u->telefono}}</li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    @if ($u->id ==1)
                    <img src="https://media.istockphoto.com/vectors/manager-icon-design-vector-id1014120620?k=6&m=1014120620&s=170667a&w=0&h=12cEYoSVejHGw7r9xxk-Qp6yGjYDRCNp0EFR48wy7fM=" alt="" class="img-circle img-fluid">  
                    @else
                      @if ($u->genero=="M")
                          <img src="https://image.flaticon.com/icons/png/512/641/641839.png" alt="" class="img-circle img-fluid">
                      @else
                          <img src="https://image.flaticon.com/icons/png/512/560/560209.png" alt="" class="img-circle img-fluid">
                      @endif
                    
                    @endif
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <a href="#" class="btn btn-sm bg-teal">
                    <i class="fas fa-comments"></i>
                  </a>
                  <a href="{{ route('vendedor.show', $u->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user"></i> Ver perfil
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endif
           
          @endforeach
    
  </section>
@stop

@section('css')
@stop

@section('js')
        
@stop