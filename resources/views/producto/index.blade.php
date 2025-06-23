@extends('layouts.app')

@section('template_title')
    Productos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card color-secundario">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Productos') }}
                            </span>
                            <div class="float-center">
                                <div class="input-group mb-3">
                                    <form id="buscar-producto" method="post">
                                        <input type="text" id="search-term" class="form-control" placeholder="Buscar producto: Código o Descripción" aria-label="Buscar producto" aria-describedby="basic-addon2">
                                        
                                    </form>
                                    
                                </div>
                            </div>
                             <div class="float-right">
                                <a href="{{ route('productos.create') }}" class="btn btn-outline-light btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    

                    <div class="card-body bg-white">
                        @if ($message = Session::get('success'))
                        <div class="alert m-4 alert-dismissible fade show">
                            <p class="text-success">{{ $message }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                       



                        <div class="table-responsive">
                            <div id="loading-message">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                             <div id="search-results"></div>
                            
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#loading-message').hide();
            $('#search-term').on('keyup', function() {
            var searchTerm = $(this).val();
                
                $.ajax({
                    url: '/buscar', // Ruta al controlador
                    method: 'GET',
                    data: { term: searchTerm,
                        front:"productos"

                    },
                    beforeSend: function() {
                        $('#loading-message').show(); 
                        
                    },
                    success: function(response) {
                        $('#loading-message').hide();
                        $('#search-results').html(response);
                    }
                });
            });
        });
    </script>
@endsection
