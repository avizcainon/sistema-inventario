@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Factura
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Factura</span>
                    </div>
                    <div class="card-body bg-white">

                    



                        <form method="POST" action="{{ route('facturas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                           
                            @include('factura.form')

                        </form>
                         <div class="table-responsive">
                                <div id="search-results"></div>
                             </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#buscador_cliente').on('keyup', function() {
            var searchTerm = $(this).val();
               
            $.ajax({
                url: '/buscar-cliente',
                method: 'GET',
                data: { id_cliente: searchTerm,
                    front:"create"
                 },
                success: function(response) {
                $('#search-results').html(response);
                }
            });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#search-results').on('click', '.add-to-list-btn', function() {
                alert("Clikeado!");
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
