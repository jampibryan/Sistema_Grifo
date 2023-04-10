<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ventas</title>
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
    <h1 class="cabeza">Reporte de Ganancias Diarias</h1>
    <hr>
    <div class="contenido">
        <div class="">
            <span class="con">Fecha de Consulta: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
        </div>
        <br>

        <div class="">
            <span class="con">Cantidad Registros: {{ $ventas->count() }} </span>
        </div>
        <br>

        <div class="">
            <span class="con">Total de ingresos: {{ $total }}</span>
        </div>
    </div>
</body>
</html>