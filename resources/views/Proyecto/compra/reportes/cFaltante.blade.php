<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        header {
            margin-bottom: 20px;
            margin-top: 30px;
        }
        .article-art-1 {
            margin-bottom: 20px;
        }

        .table-art-1 {
            border-collapse: collapse;
            width: 100%;
        }      

        .table-data {
            border-collapse: collapse;
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }
        .tamFont{
            font-size: 16px;
        }
        .t-header {
            background-color: #29877E;
            height: 30px;
            padding: 0;
            margin: 0;
        }
        .table-header {
            color: #fff;
        }
        .tr-body {
            height: 100px;
            text-align: center;
        }
        .p-foot {
            text-align: right;
            height: 30px;
        }

        thead th {
            height: 50px;
        }

        table td {
            height: 70px;
        }

        .cabeza{
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <h1 class="cabeza">REPORTE POST COMPRA</h1>
    <div style="background-color: rgb(255, 255, 255)">
        <div>
            @foreach ($compra as $item)
                <div>
                    <label for="" class="d-block" style="font-weight: bold">Número de Compra: </label>
                    <span>{{ $item->id }}</span>
                </div><br><input type="hidden" name="" value="{{ $id = $item->id }}">
                @foreach ($transportista as $tr)
                    <div>
                        <label for="" class="d-block" style="font-weight: bold">Transportista: </label>
                        <span>{{ $tr->name }} {{ $tr->apellidos }}</span>
                    </div>
                @endforeach
                <br>
                <div>
                    <label for="" class="d-block" style="font-weight: bold">Realizó orden compra: </label>
                    <span>{{ $item->name }} {{ $item->apellidos }}</span>            
                </div>
                <br>                          
                <div>
                    <label for="" class="d-block"  style="font-weight: bold">Fecha Emision: </label>
                    <span>{{ $item->fechaEmision }}</span>
                </div><br>   
                <div>
                    <label for="" class="d-block" style="font-weight: bold">Fecha Entrega: </label>
                    <span>{{ $item->fechaEntrega }}</span>
                </div> 
                <br>
                <div>
                    <input type="hidden" name="" value="{{ $estado = $item->estado }}">
                    <input type="hidden" name="" id="" value="{{ $total = $item->total }}">
                    <input type="hidden" name="" id="" value="{{ $igv = $item->igv }}">
                </div>
            @endforeach
        </div>
        <br>
        <section>
            <article>
                <table class="table-data">
                    <thead>
                        <tr class="t-header">
                            <th class="table-header">Producto</th>
                            <th class="table-header">Precio Compra</th>                        
                            <th class="table-header">Cantidad pedido</th>
                            <th class="table-header">Cantidad recibida</th>
                            <th class="table-header">SubTotal</th>
                        </tr>
                    </thead>
                    <input type="hidden" name="" id="" value="{{ $auxSub = 0; }}">
                    <tbody style="background-color: rgb(236, 236, 236)">
                        @foreach ($detalles as $detalle)
                            
                                <tr style="height: 100px;
                                text-align: center; @if ($detalle->cantidad_recibida < $detalle->cantidad) background-color:rgb(255, 218, 218); @endif" >
                                    <td>{{ $detalle->descripcion }}</td>
                                    <td>{{ $detalle->precio }}</td>                            
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>
                                        @if ($estado == "EMITIDA")
                                            No registra
                                        @else
                                            {{ $detalle->cantidad_recibida }}
                                        @endif
                                    </td>
                                    <td>{{ $detalle->subtotal }}</td>                    
                                    <input type="hidden" name="" id="" value="{{$auxSub=$auxSub+$detalle->subtotal;}}">
                                </tr>
                           
                        @endforeach
                    </tbody>
                    <input type="hidden" name="" id="" value="{{ $auxSub; }}">
                    <br>
                    <tfoot>
                        <tr>
                            <th colspan="4">
                                <p class="text-right">SUB TOTAL:</p>
                            </th>
                            <th>
                                <p class="text-right"><span>{{ number_format($auxSub, 2) }}</span></p>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4">
                                <p class="text-right">PAGO IGV:</p>
                            </th>
                            <th>
                                <p class="text-right"><span>{{ number_format($auxSub * $igv / 100, 2) }}</span></p>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4">
                                <p class="text-right">TOTAL PAGAR:</p>
                            </th>
                            <th>
                                <p class="text-right"><span>S/ {{ number_format($total, 2) }}</span></p>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </article>
        </section>
       
    </div>   
</body>
</html>

