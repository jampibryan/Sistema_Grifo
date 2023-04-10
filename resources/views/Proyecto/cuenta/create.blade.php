@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <div>
        <div class="card-header"><h3>Registro cuenta</h3></div>
    </div>
@stop

@section('content')
<div class="container">
    <a href="{{ route('cuenta.index') }}" class="btn btn-outline-secondary">Regresar</a>
    @if ($tam > 0)
        <div class="card mt-2" style="background-color: rgb(255, 255, 255)">
            <form action="{{ route('cuenta.store') }}" method="post" class="formulario">
                @csrf
                <div class="card-body">
                    <div class="row">                
                        <div class="col-12 col-md-6 form-group">
                            <label for="name">Ventas</label> 
                            <select name="" id="venta_id" class="form-control">
                                <option value="" selected disabled>Seleccione venta</option>
                                @foreach ($ventas as $venta) 
                                    <option value="{{ $venta->id }}|{{ $venta->total }}">{{ $venta->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="">Total venta</label>
                            <input type="text" id="total_venta" name="aop" class="form-control" disabled>
                        </div>
                        <button type="button" class="btn btn-success" onclick="agrega(), valorTotal()">Agregar</button>
                    </div>
                    <div class="table-responsive">
                        <table id="tdetalle" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nro Venta</th>
                                    <th>Total</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>
                                        Total
                                    </th>
                                    <th>
                                        <input type="text" name="txttotal" disabled id="opes">
                                        {{-- <p class="text-left"><span id="total_pagar_html"></span><input type="text" id="txt_jo" class="unio"></p> --}}
                                    </th>
                                </tr>    
                            </tfoot>                       
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-100" id="btn-guardar">Guardar</button>
                </div>
            </form>
        </div>
    @else
        <div class="alert alert-success mt-2" role="alert">
            No hay ventas pendientes de cuenta
        </div>
    @endif
        
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            console.log('hola');
            btn_guardar = document.querySelector('#btn-guardar')
            btn_guardar.style.display = 'none'
            valorTotal()
        })

        arrayPro = []
        var contador = 1
        // var total = 0
        suma = 0
        xsub = []

        function agrega() {
            data = document.querySelector('#venta_id').value.split('|')
            xid = data[0]
            xmonto = data[1]
            document.querySelector('#total_venta').value = xmonto
            tventa = document.querySelector('#total_venta').value
            
            if (data != "") {
                xsub[contador] = tventa
                var fila = '<tr id="fila'+contador+'"><td><input type="hidden" name="utotal[]" value="'+tventa+'">'+xid+'</td><td><input type="hidden" name="ids[]" value="'+xid+'">'+tventa+'</td><td><button type="button" class="btn btn-danger" onclick="eliminar('+contador+','+xid+')"><i class="fas fa-times"></i></button></td></tr>'
                
                if (!verRepetido(xid)) {
                    xsub[contador] = parseFloat(xsub[contador])+ tventa
                    suma = suma + parseFloat(xsub[contador])
                    // console.log(xsub[contador]);
                    // console.log(suma);
                    contador++
                    document.querySelector('#tdetalle').innerHTML += fila
                    verBtn()
                    
                } else {
                    alert("La venta ya está agregado!!")
                    arrayPro.pop()
                    valorTotal()
                }         
            } else {
                alert("Selecciona una venta!")
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
            if (suma > 0) {
                btn_guardar.style.display = 'block'
            } else {
                btn_guardar.style.display = 'none'
            }
        }

        function valorTotal() {
            
            console.log(suma);
            document.querySelector('#opes').value = suma.toFixed(2)
        } 

        function eliminar(index,id) {        
            // recalcular total            
            suma = suma - parseFloat(xsub[index])

            document.querySelector('#opes').value = suma.toFixed(2)

            document.querySelector('#fila'+index).remove()
            verBtn()
            arrayPro.splice(arrayPro.indexOf(""+id),1)        
            valorTotal()
        }

        $('.formulario').submit(function (e) {
            e.preventDefault()
            Swal.fire({
                title: '¿Seguro que desea guardar esta cuenta?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButton: '#d33',
                confirmButtonText: 'Sí'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit()
                }
            })
        })

    </script>
@stop