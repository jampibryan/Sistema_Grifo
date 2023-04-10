@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Registro de venta</strong></h1>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
@stop

@section('content')
    
    <div class="container-fluid">
        <div class="card-header bg-secondary">
            Datos del cliente
        </div>
        <form action="{{ route('venta.store') }}" method="post" class="formulario">
            @csrf
            <div class="row card-body">    
                <div class="col-12"> 
                    <label class="form-group">Buscar</label>                    
                    <select class="selectpicker border-0 mb-1 px-2 py-2 rounded shadow" id="cliente_id" onchange="valoresCliente()">
                        <option value="" selected disabled>-- Selecciona Cliente --</option>
                        @foreach ($clientes as $c)
                            <option value="{{$c->id}}|{{$c->nroDocumento}}|{{$c->tipoCliente}}">{{$c->nombre}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="cliente_id" id="idd">
                </div>
                <div class="col-12 bg-light" style="border-radius: 10px">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="staticEmail" class="form-label" id="labelTipo">TipoDocumento</label>
                                <input type="text" style="border: 1; background: transparent;" readonly class="form-control" id="documento" value="NroDocumento">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                            <label for="staticEmail" class="form-label">Tipo Cliente</label>
                                <input type="text" style="border: 1; background: transparent;" readonly class="form-control" id="tipoCliente" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-8 cart">
                        {{-- Productos --}}
                        <div class="title"> 
                            <div class="row">
                                <div class="col">
                                    <h4><b>Productos</b></h4>
                                </div>
                            </div>
                            <div class="row col align-items-center" >
                                <div class="row col-12  align-items-center mb-1">
                                    <div class="col-8">
                                        <select id="producto_id" name="producto_id" class="selectpicker2 border-1 mb-1 px-2 py-2 rounded" onchange="valoresProducto()">
                                            <option value="" disabled selected>-- Seleccione producto --</option>
                                            @foreach ($productos as $p)
                                                <option value="{{$p->id}}_{{$p->cantidad}}_{{$p->precio}}">{{$p->descripcion}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                    
                                    <div class="col-4">
                                        <input  type="text" id="precio" disabled value="">
                                    </div>                            
                                </div>
                                <div class="row col-12 mb-1">
                                    <div class="col-6">
                                        <label for="">Cantidad</label><br>
                                        <input type="text" name="" id="cantidad" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label for="">Tipo Pago</label><br>
                                        <select name="tipo_id" id="tipo_id" class="form-control">
                                            <option value="" selected disabled>-- Selecciona tipo pago --</option>
                                            @foreach ($tipo as $t)
                                                <option value="{{ $t->id }}">{{ $t->descripcionTipoPago }}</option>
                                            @endforeach             
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-success" id="btnAgregar" type="button" style="border: solid; margin-top: auto; margin-bottom: auto" onclick="carrito()">Añadir</button>
                            </div>
                        </div>
        
                        <hr>
                    {{-- INICIO TABLA DETALLE --}}
                        <div class="table-responsive">
                            <table id="tdetalle" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>                        
                            </table>
                        </div>
                    {{-- FIN TABLA DETALLE --}}
                        <hr>
                        <div class="back-to-shop">
                            <a href="{{ route('venta.index') }}" class="btn btn-light">Cancelar</a>
                        </div>
                    </div>
                    <div class="col-md-4 summary">
                        <div>
                            <h5><b>RESUMEN</b></h5>
                        </div>
                        <hr>
                        <div class="row">
                            <p class="col">Total</p> 
                            <div class="col text-right">S/ <label id="total_html">00.00</label></div>
                        </div>
                        <div class="row">
                            <p class="col">Pago IGV</p> 
                            <div class="col text-right">S/ <label id="igv_html">00.00</label></div>
                        </div>
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col">Total a Pagar</div>
                            <div class="col text-right">S/ <label id="total_pagar_html">00.00</label><input type="hidden" name="total" id="inTotalPagar"></div>
                        </div>
                        <button type="submit" class="btn btn-dark" id="btn-vender">VENDER</button>            
                    </div>
                </div>
            </div>                
        </form>
    </div>
    <br>
@stop

@section('css')
    <style>
        body {
            background: #ddd;
            min-height: 100vh;
            vertical-align: middle;
            font-family: sans-serif;
            font-size: 0.8rem;
            font-weight: bold
        }

        .title {
            margin-bottom: 5vh
        }

        .card2 {
            margin: auto;
            max-width: 950px;
            width: 90%;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 1rem;
            border: transparent
        }

        @media(max-width:767px) {
            .card2 {
                margin: 3vh auto
            }
        }

        .cart {
            background-color: #fff;
            padding: 4vh 5vh;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem
        }

        @media(max-width:767px) {
            .cart {
                padding: 4vh;
                border-bottom-left-radius: unset;
                border-top-right-radius: 1rem
            }
        }

        .summary {
            background-color: #ddd;
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
            padding: 4vh;
            color: rgb(65, 65, 65)
        }

        @media(max-width:767px) {
            .summary {
                border-top-right-radius: unset;
                border-bottom-left-radius: 1rem
            }
        }

        .summary .col-2 {
            padding: 0
        }

        .summary .col-10 {
            padding: 0
        }

        .row {
            margin: 0
        }

        .title b {
            font-size: 1.5rem
        }

        .main {
            margin: 0;
            padding: 2vh 0;
            width: 100%
        }

        .col-2,
        .col {
            padding: 0 1vh
        }

        a {
            padding: 0 1vh
        }

        .close {
            margin-left: auto;
            font-size: 0.7rem
        }

        img {
            width: 3.5rem
        }

        .back-to-shop {
            margin-top: 4.5rem
        }

        h5 {
            margin-top: 4vh
        }

        hr {
            margin-top: 1.25rem
        }

        form {
            padding: 2vh 0
        }

        select {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1.5vh 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247)
        }

        input {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247)
        }

        input:focus::-webkit-input-placeholder {
            color: transparent
        }

        .btn {
            background-color: #000;
            border-color: #000;
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0
        }

        .btn:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            -webkit-user-select: none;
            transition: none
        }

        .btn:hover {
            color: white
        }

        a {
            color: black
        }

        a:hover {
            color: black;
            text-decoration: none
        }

        #code {
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center
        }

        .bg-light {
        background: #eef0f4;
        }

        .choices__list--dropdown .choices__item--selectable {
        padding-right: 1rem;
        }

        .choices__list--single {
        padding: 0;
        }


        .choices[data-type*=select-one]:after {
        right: 1.5rem;
        }

        .shadow {
        box-shadow: 0.3rem 0.3rem 1rem rgba(178, 200, 244, 0.23);
        }

        a {
        text-decoration: none;
        color: inherit;
        transition: all 0.3s;
        }
    </style>
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const sorting = document.querySelector('.selectpicker');
    const commentSorting = document.querySelector('.selectpicker');
    const sortingchoices = new Choices(sorting, {
        placeholder: false,
        itemSelectText: ''
    });

    // Trick to apply your custom classes to generated dropdown menu
    let sortingClass = sorting.getAttribute('class');
    window.onload= function () {
        sorting.parentElement.setAttribute('class', sortingClass);
    }

    const sorting2 = document.querySelector('.selectpicker2');
    const commentSorting2 = document.querySelector('.selectpicker2');
    const sortingchoices2 = new Choices(sorting2, {
        placeholder: false,
        itemSelectText: ''
    });

    // Trick to apply your custom classes to generated dropdown menu
    let sortingClass2 = sorting2.getAttribute('class');
    window.onload= function () {
        sorting2.parentElement.setAttribute('class', sortingClass2);
    }


    function valoresCliente() {
        dataCliente = document.getElementById('cliente_id').value.split('|')
        document.querySelector('#documento').value = dataCliente[1]
        document.querySelector('#tipoCliente').value = dataCliente[2]
        document.querySelector('#idd').value = dataCliente[0]

        tipoCliente = dataCliente[2]
        if (tipoCliente == 'JURIDICO') {
            document.querySelector('#labelTipo').innerHTML = 'RUC'
        }
        else if (tipoCliente == 'NATURAL') {
            document.querySelector('#labelTipo').innerHTML = 'DNI'   
        }
    }

    function valoresProducto(){
        dataProducto = document.querySelector('#producto_id').value.split('_')
        document.querySelector('#precio').value = dataProducto[2]
    }

    var contador = 1
    var total = 0
    subtotal = []
    arrayPro = []

    btn_vender = document.querySelector('#btn-vender')
    btn_vender.style.display = 'none'

    function carrito() {
        dataPro = document.querySelector('#producto_id').value.split('_')
        cbx = document.querySelector('#producto_id')
        producto_id = dataPro[0]        
        nombreProd = cbx.options[cbx.selectedIndex].text
        precio = dataPro[2]
        stock = dataPro[1]
        tipoPago = document.querySelector('#tipo_id').value
        cantidad = document.querySelector('#cantidad').value
        
        cliente_id = document.querySelector('#cliente_id').value

        if (cliente_id != "") {
            if (producto_id != "" && cantidad != "" && tipoPago != "") {
                if (cantidad > 0) {
                    if (parseInt(stock) >= parseInt(cantidad)) {
                        subtotal[contador] = cantidad*precio                        
                        var fila = '<tr class="selected" id="fila'+contador+'"><td><input type="hidden" name="producto_id[]" value="'+producto_id+'">'+nombreProd+'</td><td><input type="hidden" name="cantidad[]" value="'+cantidad+'"><input class="form-control" type="number" value="'+cantidad+'" disabled></td><td>'+(parseFloat(subtotal[contador])).toFixed(2)+'</td><input type="hidden" id="precio[]" name="precio[]" value="'+parseFloat(precio).toFixed(2)+'"><td><button type="button" class="btn btn-danger" onclick="eliminar('+contador+','+producto_id+')"><i class="fas fa-times"></i></button></td></tr>'
                        contador++                    

                        if (!verRepetido(producto_id)) {
                            subtotal[contador] = cantidad*precio
                            total = total + subtotal[contador]
                            valorTotal()
                            document.querySelector('#tdetalle').innerHTML += fila
                            verBtn()                        
                        } else {
                            Swal.fire({
                                type: 'error',
                                icon: 'error',
                                text: 'El producto ya está agregado',
                            })
                            arrayPro.pop()
                            valorTotal()
                            document.querySelector('#cantidad').value = ""
                        }

                    } else {
                        //  STOCK INSUFICIENTE
                        Swal.fire({
                            type: 'error',
                            icon: 'error',
                            text: 'No se cuenta con el stock suficiente',
                        })
                        document.querySelector('#cantidad').focus()
                    }
                } else {
                    // INGRESE CANTIDAD VALIDA
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        text: 'Ingrese una cantidad válida',
                    })
                    document.querySelector('#cantidad').focus()
                }
            } else {
                // SELECCIONAR PRODUCTO Y LLENAR CANTIDAD QUE PIDE
                Swal.fire({
                    type: 'error',
                    icon: 'error',
                    text: 'Seleccione producto y/o llene cantidad',
                })
            }
        } else {
            Swal.fire({
                type: 'error',
                icon: 'error',
                text: 'Seleccione un cliente!',
            })
        }
    }


    function verRepetido(id) {
        arrayPro.push(id)
        let bol = false
        for (let i = 0; i < arrayPro.length; i++) {
            for (let j = 0; j < arrayPro.length; j++) {
                if (arrayPro[i] == arrayPro[j] && i != j) {
                    bol = true                    
                }
            }        
        }
        return bol
    }

    function verBtn() {
        if (total > 0) {
            btn_vender.style.display = 'block'
        } else {
            btn_vender.style.display = 'none'
        }
    }

    function valorTotal() {
        document.querySelector('#total_html').innerHTML = total.toFixed(2)
        pago_igv = total * 0.18
        total_pagar = total + pago_igv

        document.querySelector('#igv_html').innerHTML = pago_igv.toFixed(2)
        document.querySelector('#total_pagar_html').innerHTML = total_pagar.toFixed(2)
        document.querySelector('#inTotalPagar').value = total_pagar.toFixed(2)
    }

    function eliminar(index,id) {        
        // recalcular total
        total = total - subtotal[index]
        pago_igv = total * 0.18
        total_pagar = total + pago_igv

        document.querySelector('#total_html').innerHTML = total.toFixed(2)

        document.querySelector('#igv_html').innerHTML = pago_igv.toFixed(2)
        document.querySelector('#total_pagar_html').innerHTML = total_pagar.toFixed(2)
        document.querySelector('#inTotalPagar').value = total_pagar.toFixed(2)        
        document.querySelector('#fila'+index).remove()
        verBtn()
        arrayPro.splice(arrayPro.indexOf(""+id),1)        
    }

    $('.formulario').submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Confirmar guardado?',
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
    })
</script>
@stop