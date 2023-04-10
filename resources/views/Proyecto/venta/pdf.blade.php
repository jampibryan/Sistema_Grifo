<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante</title>
    <style>
        .cabeza{
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
        .contenido{
            width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .con{
            font-family: Georgia, "Times New Roman", Times, serif;
            font-size: 18px;
            height: 10px;
            width: 200px;
            margin-left: 10px;
            margin-right:15px;
        }
        .tabla{
            width: 600px;
            text-align: left;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }
        td{
            padding: 10px;
        }
        thead{
            background-color: #246355;
            border-bottom: solid 5px;
            color: white;
            font-family: Arial, Helvetica, sans-serif;
        }
        .fila{
            background-color: #ddd;
            font-family: Arial, Helvetica, sans-serif;
        }
        .p{
            font-family: Arial, Helvetica, sans-serif;
            padding: 10px;
            text-align: left;
        }
        
    </style>
</head>
<body>
    <h1 class="cabeza">COMPROBANTE DE VENTA</h1>
    <div class="contenido">
        @foreach ($venta as $item)
            <div class="">
                <label for="" class=""><strong>Número de Venta: </strong></label>
                <span>{{ $item->id }}</span>
                <input type="hidden" name="" value="{{ $id = $item->id }}">
            </div>
            <br>
            <div class="">
                <label for="" class=""><strong>Cliente: </strong></label>
                <span>{{$item->nombre}}</span>
            </div>
            <br>
            <div class="">
                <label for="" class=""><strong>Vendedor: </strong></label>
                <span>{{ $item->name }} {{ $item->apellidos }}</span>            
            </div>
            <br>
            <div class="">
                <label for="" class=""><strong>Estado Venta: </strong></label>
                <span>{{ $item->estado }}</span>
                <input type="hidden" name="" value="{{ $estado = $item->estado }}">
                <input type="hidden" name="" id="" value="{{ $total = $item->total }}">
                <input type="hidden" name="" id="" value="{{ $igv = $item->igv }}">
            </div>
            <br>
            <div class="">
                <label for="" class=""><strong>Tipo de pago: </strong></label>
                <span>{{ $item->descripcionTipoPago }}</span>            
            </div>
        @endforeach
    </div>
    <br><br>
    <table id="detalles" class="tabla">
        <thead>
            <tr>
                <td>Producto</td>
                <td>Precio Venta</td>
                <td>Cantidad</td>
                <td>SubTotal</td>
            </tr>
        </thead>
        <input type="hidden" name="" id="" value="{{ $auxSub = 0; }}">
        <tbody>
            @foreach ($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->descripcion }}</td>
                    <td>{{ $detalle->precio }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->subtotal }}</td>                    
                    <input type="hidden" name="" id="" value="{{$auxSub=$auxSub+$detalle->subtotal;}}">
                </tr>
            @endforeach
            
        </tbody>
        <input type="hidden" name="" id="" value="{{ $auxSub; }}">
        <tfoot>
            <tr>
                <th colspan="3">
                    <p class="">SUB TOTAL:</p>
                </th>
                <th>
                    <p class=""><span>{{ number_format($auxSub, 2) }}</span></p>
                </th>
            </tr>
            <tr>
                <th colspan="3">
                    <p class="">PAGO IGV:</p>
                </th>
                <th>
                    <p class=""><span>{{ number_format($auxSub * $igv / 100, 2) }}</span></p>
                </th>
            </tr>
            <tr>
                <th colspan="3">
                    <p class="">TOTAL PAGAR</p>
                </th>
                <th>
                    <p class=""><span>S/ {{ number_format($total, 2) }}</span></p>
                </th>
            </tr>
        </tfoot>
    </table>
</body>
</html>