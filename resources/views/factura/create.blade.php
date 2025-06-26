@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Factura
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default color-secundario">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                         <div class="float-left">
                            <span class="card-title text-secondary">{{ __('Create') }} factura</span>
                        </div>
                       

                        <div class="float-right">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('facturas.index') }}"> <i class="bi bi-arrow-return-left"></i></a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('facturas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                           
                            @include('factura.form')

                        </form>
                         <div class="table-responsive">
                            <div id="search-results"></div>
                            <div id="loading-message-cliente">
                                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#loading-message').hide();
            $('#loading-message-cliente').hide();
            $('#buscador_cliente').on('keyup', function() {
            var searchTerm = $(this).val();
               
            $.ajax({
                url: '/buscar-cliente',
                method: 'GET',
                data: { id_cliente: searchTerm,
                    front:"create"
                 },
                    beforeSend: function() {
                        $('#loading-message').show(); 
                        $('#loading-message-cliente').show(); 
                        
                    },
                success: function(response) {
                $('#search-results').html(response);
                $('#loading-message').hide(); 
                $('#loading-message-cliente').hide();
                }
            });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#search-results').on('click', '.add-to-list-btn', function() {
                const clientId = $(this).data('clientId');
                const clientDni = $(this).data('clientDni');
                const clientNombre = $(this).data('clientNombre');
                const clientApellido = $(this).data('clientApellido');
            $("#id_cliente").val(clientId); 
            $("#buscador_cliente").val(clientDni +" "+clientNombre+" "+clientApellido); 
            
            }); 
        });
</script>
@endsection
