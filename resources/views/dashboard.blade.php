@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<script>
  var id = 0;
  var id2 = 0;
  var id3 = 0;
  var listaDescripcionProductoCombustible =[];
  var listaCantidadProductoCombustible =[];
  var lista3= [];
  var listaDescripcionProductoComestible =[];
  var listaCantidadProductoComestible =[];
  var listaDescripcionProductoAceilubris =[];
  var listaCantidadProductoAceilubris =[];

</script>

{{-- LLenado array combustibles --}}
@for ($i = 0; $i < $contadorCombustible; $i++)
  <input type="hidden" id="combustiblevendido{{$i}}" value="{{$listaCombustibles['producto'][$i]}}_{{$listaCombustibles['cantidad'][$i]}}">
  <script>
    datosproducto=document.getElementById("combustiblevendido" + id++).value.split('_');
    listaDescripcionProductoCombustible.push(datosproducto[0]);
    listaCantidadProductoCombustible.push(datosproducto[1]);
  </script>
@endfor
{{-- Llenado array comestibles --}}
@for ($i = 0; $i < $contadorComestible; $i++)
  <input type="hidden" id="comestiblevendido{{$i}}" value="{{$listaComestibles['producto'][$i]}}_{{$listaComestibles['cantidad'][$i]}}">
  <script>
    datosproducto=document.getElementById("comestiblevendido" + id2++).value.split('_');
    listaDescripcionProductoComestible.push(datosproducto[0]);
    listaCantidadProductoComestible.push(datosproducto[1]);
  </script>
@endfor
{{-- Llenado array lubricantes y aceites --}}
@for ($i = 0; $i < $contadorAceiLubris; $i++)
  <input type="hidden" id="aceilubrivendido{{$i}}" value="{{$listaAceiLubris['producto'][$i]}}_{{$listaAceiLubris['cantidad'][$i]}}">
  <script>
    datosproducto=document.getElementById("aceilubrivendido" + id3++).value.split('_');
    listaDescripcionProductoAceilubris.push(datosproducto[0]);
    listaCantidadProductoAceilubris.push(datosproducto[1]);
  </script>
@endfor

{{-- Ventas meses --}}
<input type="hidden" id="aux1" value="{{$contadorCombustible}}">
<script>
  var cont = parseInt(document.getElementById('aux1').value);
  console.log(cont)
</script>
@for ($i = 0; $i < 13; $i++)

  <input type="hidden" id="{{$contadorCombustible + $i}}" value="{{$listaVentasMensuales[$i]}}">
  <script>
    ventas=document.getElementById(cont++).value;
    lista3.push(ventas);
  </script>
@endfor
{{--...................--}}

<script>
  lista3.splice(0,1);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js" integrity="sha512-ELgdXEUQM5x+vB2mycmnSCsiDZWQYXKwlzh9+p+Hff4f5LA+uf0w2pOp3j7UAuSAajxfEzmYZNOOLQuiotrt9Q==" crossorigin="anonymous"></script>
@stop



@section('content')

  <div>
    <h1 class="display-4">Bienvenido!</h1>
    <p class="lead">Sistema de administracion</p>
    <hr>
  </div>

  <div class="row">
   
    <!-- Graficos -->
    <div class="col-lg-9">  
        {{-- Ventas de productos --}}
        <div>
          <section class="connectedSortable ui-sortable">
            <div class="card">

              {{-- Cabecera --}}
              <div class="card-header ui-sortable-handle">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Productos vendidos
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Combustibles</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Comestibles</a>
                    </li>
                    {{-- <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Aceites y lubricantes</a>
                    </li> --}}
                  </ul>
                </div>
              </div>

              {{-- Graficos --}}
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
                    <canvas id="myChart" height="100" style="height: 0px; display: block; width: 0px;"></canvas>
                  </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative;">
                    <canvas id="myChart2" height="" style="height: 0px; display: block; width: 0px;" width="0" ></canvas>                         
                  </div>  
                  <div class="chart tab-pane" id="sales-chart" style="position: relative;">
                    <canvas id="myChart4" height="" style="height: 0px; display: block; width: 0px;" width="0" ></canvas>                         
                  </div> 
                  
                </div>
              </div>
            </div>
          </section>
        </div>

        {{-- Ventas por mes --}}
        <div>
          <div class="card">
            <div class="card-header ui-sortable-handle">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Ventas Mensuales
              </h3>
            </div>
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
                  <canvas id="myChart3" height="100" style="height: 0px; display: block; width: 0px;"></canvas>
                </div>
              </div>
            </div>
          </div>
            
        </div>

    </div>

    <!-- Cajitas totales hoy mes año -->
    <div class="col-lg-3 col-6" >
      <div class="list-group" id="player-list">

      <div class="list-group-item">
        <div class="handle thumbnail flex-center">
          <div>
          <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Totales</h3>
        
                <p> Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag">{{$nVentasT}}</i>
              </div>
              @can('venta.index')
                <a href="{{ route('venta.index') }}" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
        </div>
      </div>

      <div class="list-group-item">
        <div class="handle thumbnail flex-center">
          <div>
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Hoy</h3>
        
                <p>Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag">{{$nVentasHoy}}</i>
              </div>
              @can('venta.index')
                <a href="{{ route('venta.index') }}" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
        </div>
      </div>

      <div class="list-group-item">
        <div class="handle thumbnail flex-center">
          <div>
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Este Mes</h3>
        
                <p>Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add">{{$nVentasMes}}</i>
              </div>
              @can('venta.index')
                <a href="{{ route('venta.index') }}" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
        </div>
      </div>

      <div class="list-group-item">
        <div class="handle thumbnail flex-center">
          <div>
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Este Año</h3>
        
                <p>Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph">{{$nVentasAño}}</i>
              </div>
              @can('venta.index')
                <a href="{{ route('venta.index') }}" class="small-box-footer">More información<i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
        </div>
      </div>

      </div>
    </div>
 </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
      .list-group .list-group-item .handle {cursor:move} 
    </style>
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
  
  <script>
    //Combustibles
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: listaDescripcionProductoCombustible,
          datasets: [{
              label: 'Galones vendidos',
              data: listaCantidadProductoCombustible,
              backgroundColor: [
                  'rgba(255, 99, 132)',
                  'rgba(54, 162, 235)',
                  'rgba(255, 206, 86)',
                  'rgba(75, 192, 192)',
                  'rgba(153, 102, 255)',
                  'rgba(255, 159, 64)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
    });

    //Comestibles
    var ctx2 = document.getElementById('myChart2').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: listaDescripcionProductoComestible,
            datasets: [{
                label: 'Cantidad vendida',
                data: listaCantidadProductoComestible,
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 159, 64)'
                ],
                hoverOffset: 6
            }]
        },
        options: {
          maintainAspectRatio : false,
          responsive : true,
        }
    });

    //Aceites lubricantes
    var ctx4 = document.getElementById('myChart4').getContext('2d');
    var myChart4 = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: listaDescripcionProductoAceilubris,
            datasets: [{
                label: 'Cantidad vendida',
                data: listaCantidadProductoAceilubris,
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 159, 64)'
                ],
                hoverOffset: 6
            }]
        },
        options: {
          maintainAspectRatio : false,
          responsive : true,
        }
    });

    //Arrastrables
    let player = document.getElementById("player-list");
    new Sortable(player,{
      handle:'.handle',
      animation:200
    });

    //Ventas en meses
    var ctx3 = document.getElementById('myChart3').getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            datasets: [{
                label: 'N° Ventas',
                data: lista3,
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 159, 64)'
                ],
                hoverOffset: 6
            }]
        },
        options: {
          scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

  </script>
  
@stop