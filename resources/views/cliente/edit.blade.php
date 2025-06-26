@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Cliente
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default color-secundario">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                       
                        <div class="float-left">
                            <span class="card-title">{{ __('Update') }} Cliente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('clientes.index') }}"> <i class="bi bi-arrow-return-left"></i></a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('clientes.update', $cliente->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('cliente.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
