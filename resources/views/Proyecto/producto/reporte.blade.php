<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Producto</title>
</head>
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
<body>
    <h1 class="cabeza">Reporte de los productos</h1>
    <hr>
    <div>
        <div>
            <table class="tabla">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre producto</td>
                        <td>Cantidad</td>
                        <td>Categorias</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($producto as $item)
                        <tr class="fila">
                            <td>{{$item->id}}</td>
                            <td>{{$item->descripcion}}</td>
                            <td>{{$item->cantidad}}</td>
                            <td>{{$item->categorias}}</td>
                        </tr>
                    @endforeach
                </tbody><br><br>
                <tfoot>
                
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>