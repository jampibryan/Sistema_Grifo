@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <br>
    <div class="col">
        <div class="card">
            <img class="card-img-top" src="holder.js/100x180/" alt="">
            <div class="card-body">
                <div class="alert alert-primary" role="alert">
                    <strong>REPORTE INGRESO DE VENTAS</strong>
                </div>
                <p class="card-text">Generar reporte de total de ventas durante un año y mes especifico</p>
                <div>
                    <form id="formulario" class="row col-12" action="" method="get">
                        @csrf
                        <div class="col-3">
                            <div class="form-group">
                                <label for="mes">Mes</label>
                                <select class="form-control" name="mes" id="mes">
                                    @foreach ($mesesunique as $item)
                                        <option value="{{$item+1}}">{{$mesesNombre[$item]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="año">Año</label>
                               
                                <select class="form-control" name="año" id="año">
                                    @foreach ($añosunique as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div style="text-align: center"><label for="">Listar ventas</label></div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success">Ver</button>
                            </div>
                        </div>
                    </form>
                  </div>
                <div>
                    <input type="text" hidden value="{{$total = 0}}">
                    <table class="table table-hover table-inverse">
                        <thead class="thead-default">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Importe</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleVentas as $dv)
                                
                                <tr>
                                    <td scope="row">{{$dv->Producto}}</td>
                                    <td>{{$dv->Cantidad}}</td>
                                    <td>{{$dv->Total}}</td>
                                </tr>
                                <input type="text" hidden {{$total += $dv->Total}}>
                                @endforeach
                            </tbody>
                        <tfoot>
                            <tr>
                                <input id="total" hidden value="{{$total}}">
                                <td colspan="3"><h3 for="">Monto total: S/ {{$total}}</h3></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')

@stop
