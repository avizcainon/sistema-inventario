@extends('layouts.app')

@section('template_title')
    {{ $tipoFactura->name ?? __('Show') . " " . __('Tipo Factura') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Tipo Factura</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('tipo-facturas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion Tipo Factura:</strong>
                                    {{ $tipoFactura->descripcion_tipo_factura }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
