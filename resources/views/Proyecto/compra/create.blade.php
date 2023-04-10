@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Registro compra</strong></h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('compra.store') }}" method="POST" class="formcompra">
                    @csrf
                    <div class="for-group">
                        <label for="proveedor_id">Proveedor</label>
                        <select name="proveedor_id" id="proveedor_id" class="form-control">
                            <option value="" disabled selected>Seleccione el proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}"
                                    {{ (old('proveedor_id') == $proveedor->id) ? 'selected' : '' }}    
                                > {{$proveedor->nombre}} </option>
                            @endforeach
                        </select>
                        @error('proveedor_id')
                            <span class="text-danger">* {{ $message }}</span>
                        @enderror                       
                    </div>
                    <div class="form-group">
                        <label for="producto_id">Producto</label>
                        <select name="producto_id" id="producto_id" class="form-control">
                            <option value="" disabled selected>Seleccione un producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}" {{ (old('product_id') ? 'selected' : '') }}> {{$producto->descripcion}} </option>
                            @endforeach
                        </select>
                        @error('producto_id')
                            <span class="text-danger">* {{ $message }}</span>
                        @enderror                      
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="text" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad') }}">
                        @error('cantidad')
                            <small class="text-danger">*{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio compra</label>
                        <input type="text" name="precio" id="precio" class="form-control" value="{{ old('precio') }}">
                        @error('precio')
                            <small class="text-danger">*{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Fecha de entrega</label>
                        <input type="date" name="fechaEntrega" id="fechaentrega" class="form-control">
                        @error('fechaEntrega')
                            <span class="text-danger">* {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Asignar Transportista</label>
                        <select name="tran_id" id="tran_id" class="form-control">
                            <option value="" disabled selected>Selecciona transportista</option>
                            @foreach ($transportistas as $item)
                                <option value="{{ $item->id }}" {{ (old('tran_id') == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" id="añadir" class="btn btn-success" onclick="add()">Agregar</button>
                    </div>

                    <div class="form-group">
                        <div class="table-responsive col-md-12">
                            <table id="tdetalle" class="table table-striped">
                                <thead>
                                    <tr>                                        
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Eliminar</th>
                                        {{-- <th>Subtotal</th> --}}
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">
                                            <p class="text-right">Subtotal:</p>
                                        </th>
                                        <th>
                                            <p class="text-right"><span id="total_html">0.00</span></p>
                                        </th>
                                    </tr>
                                    <tr id="dvOcultar">
                                        <th colspan="3">
                                            <p class="text-right">Pago IGV:</p>
                                        </th>
                                        <th>
                                            <p class="text-right"><span id="igv_html">0.00</span></p>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            <p class="text-right">Total a pagar</p>
                                        </th>
                                        <th>
                                            <p class="text-right"><span id="total_pagar_html">0.00</span><input type="hidden" name="total" id="inTotalPagar"></p>
                                        </th>
                                    </tr>
                                </tfoot>
                                <tbody>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <button type="submit" id="btn-comprar" class="btn btn-primary px-4 py-2 mr-2">Comprar</button>
                    </div>
                </form>
                <div class="text-right">
                    <form action="{{ route('compra.index') }}" method="get" class="formcancelar">
                        <button type="submit" class="btn btn-light btn-lg">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var contador = 1
        var total = 0
        subtotal = []
        arrayR = []

        btn_comprar = document.querySelector('#btn-comprar')
        btn_comprar.style.display = 'none'

        function add() {
            xProducto = document.querySelector('#producto_id')
            proveedor_id = document.querySelector('#proveedor_id').value
            producto_id = xProducto.value            
            nombreProd = xProducto.options[xProducto.selectedIndex].text
            
            cantidad = document.querySelector('#cantidad').value
            precio = document.querySelector('#precio').value
            fecha = document.querySelector('#fechaentrega').value
            transp_id = document.querySelector('#tran_id').value

            let date = new Date();
            dateaux = date.toISOString().split('T')[0]

            if (proveedor_id != "") {
                if (fecha >= dateaux) {
                    if (producto_id != "" && cantidad != "" && precio != "" && fecha != "" && transp_id != "") {
                        if (cantidad > 0) {
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
                                arrayR.pop()
                                valorTotal()
                                document.querySelector('#cantidad').value = ""
                            }

                        } else {
                            Swal.fire({
                                type: 'error',
                                icon: 'error',
                                text: 'Ingrese una cantidad válida!'
                            })
                        }
                    } else {
                        Swal.fire({
                            type: 'error',
                            icon: 'error',
                            text: 'Complete todos los campos!'
                        })
                    }
                } else {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        text: 'La fecha de entrega debe ser mayor o igual a la fecha de hoy!'
                    })
                }
                
            } else {
                Swal.fire({
                    type: 'error',
                    icon: 'error',
                    text: 'Selecciona Proveedor!'
                })
            }
        }

        $('.formcancelar').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Seguro que desea cancelar el proceso?',
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
        });

        $('.formcompra').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Seguro que efectuar esta compra?',
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
        });

        function verRepetido(id) {
            arrayR.push(id)
            let bol = false
            for (let i = 0; i < arrayR.length; i++) {
                for (let j = 0; j < arrayR.length; j++) {
                    if (arrayR[i] == arrayR[j] && i != j) {
                        bol = true
                    }
                }
            }
            return bol
        }

        function verBtn() {
            if (total > 0) {
                btn_comprar.style.display = 'inline-block'
            } else {
                btn_comprar.style.display = 'none'
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

        function eliminar(index, id){
            total = total - subtotal[index]
            pago_igv = total * 0.18
            total_pagar = total + pago_igv

            document.querySelector('#total_html').innerHTML = total.toFixed(2)

            document.querySelector('#igv_html').innerHTML = pago_igv.toFixed(2)
            document.querySelector('#total_pagar_html').innerHTML = total_pagar.toFixed(2)
            document.querySelector('#inTotalPagar').value = total_pagar.toFixed(2)        
            document.querySelector('#fila'+index).remove()
            verBtn()
            arrayR.splice(arrayR.indexOf(""+id),1) 
        }
    </script>
@stop