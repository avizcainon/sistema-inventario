@extends('layouts.app')

@section('template_title')
    {{ $producto->name ?? __('Show') . " " . __('Producto') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('productos.index') }}"><i class="bi bi-arrow-return-left"></i></a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    @if ($producto->imagen_producto)
                                                @if(str_starts_with($producto->imagen_producto, 'https') || str_starts_with($producto->imagen_producto, 'http'))
                                                    <img src="{{ $producto->imagen_producto }}" class="img-fluid" id="imagen_producto" alt="Imagen producto" >
                                                @else
                                                    <img src="{{ asset('imagenes/' . $producto->imagen_producto) }}" class="img-fluid" id="imagen_producto" alt="Imagen producto" >
                                                @endif              
                                            @else
                                                <img src="{{ asset('imagenes/producto-generico.webp' ) }}" class="img-fluid" id="imagen_producto" alt="Imagen producto" >
                                            @endif 
                                </div>
                                <div class="col">
                                    <div class="form-group mb-2 mb20">
                                        <strong>Codigo Producto:</strong>
                                         {{ $producto->codigo_producto }}
                                    </div>
                                    <div class="form-group mb-2 mb20">
                                        <strong>Descripcion Producto:</strong>
                                        {{ $producto->descripcion_producto }}
                                    </div>
                                    <div class="form-group mb-2 mb20">
                                        <strong>Cantidad Producto:</strong>
                                        {{ $producto->cantidad_producto }}
                                    </div>
                                    <div class="form-group mb-2 mb20">
                                        <strong>Monto Producto Compra:</strong>
                                        {{ $producto->monto_producto_compra }}
                                    </div>
                                    <div class="form-group mb-2 mb20">
                                        <strong>Monto Producto Venta:</strong>
                                        {{ $producto->monto_producto_venta }}
                                    </div>
                                    <div class="form-group mb-2 mb20">
                                        <strong>Medida Producto:</strong>
                                        {{ $producto->medida_producto }}
                                    </div>
                                    <div class="form-group mb-2 mb20">
                                        <strong>Id Status Producto:</strong>
                                        {{ $producto->statusProducto->descripcion_status_producto }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                                

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
