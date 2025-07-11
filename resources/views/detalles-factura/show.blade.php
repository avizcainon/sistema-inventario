@extends('layouts.app')

@section('template_title')
    {{  __('Show') . " " . __('Detalles Factura') }}
@endsection

@section('content')


<section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card color-secundario">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Detalles') }} Factura</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-outline-light btn-sm" href="{{ route('facturas.index') }}"> <i class="bi bi-arrow-return-left"></i></a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                                <div class="form-group mb-2 mb20">
                                    <p class="fw-bold fs-2 text-danger">
                                        N° Factura:
                                        <strong> {{ $factura->id }}</strong>
                                        
                                    </p>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2 mb20">
                                            <strong>Cliente:</strong>
                                            {{ $factura->cliente->dni }} {{ $factura->cliente->nombre }} {{ $factura->cliente->apellido }}
                                        </div>
                                        <div class="form-group mb-2 mb20">
                                            <strong>Teléfono:</strong>
                                            {{ $factura->cliente->telefono}}
                                        </div>
                                        <div class="form-group mb-2 mb20">
                                            <strong>Correo:</strong>
                                            {{ $factura->cliente->correo}}
                                        </div>
                                    
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2 mb20">
                                            <strong>Status:</strong>
                                            {{ $factura->statusFactura->descripcion_status_factura}} 
                                        </div>
                                        <div class="form-group mb-2 mb20">
                                            <strong>Tipo:</strong>
                                            {{ $factura->tipoFactura->descripcion_tipo_factura}} 
                                        </div>
                                    </div>
                                </div> 
                
                                </div>
                  
                           <table class="table table-striped table-hover">
                                <thead class="thead color-secundario">
                                    <tr class="color-secundario">
                                        <th class="color-secundario">Cantidad </th>
                                        <th class="color-secundario">Producto </th>  
									    <th class="color-secundario">Monto</th>
									    <th class="color-secundario">Monto total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesFacturas as $detallesFactura)
                                        <tr>
                                            <td >{{ $detallesFactura->cantidad_producto_factura }}</td>
                                            <td>
                                                {{ $detallesFactura->producto->codigo_producto }} {{ $detallesFactura->producto->descripcion_producto }}
                                            </td>
                                            <td >
                                                {{ $detallesFactura->monto_producto_factura }}
                                            </td>
                                            <td >
                                                {{$detallesFactura->cantidad_producto_factura * $detallesFactura->monto_producto_factura}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>     

                    </div>
                </div>
            </div>
        </div>
    </section>



    
@endsection
