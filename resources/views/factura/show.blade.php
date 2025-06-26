@extends('layouts.app')

@section('template_title')
    {{ $factura->name ?? __('Show') . " " . __('Factura') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card color-secundario">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Add Producto') }} a factura</span>
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
                                        <div class="input-group mb-3">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                           <i class="bi bi-search"></i>
                                            </button>
                                            
                                            
                                        </div>
                                    </div>

                                </div> 
                            </div> 

                            <div class="card-body bg-white">
                        
                                <form method="POST" action="{{ route('detalles-facturas.store') }}"  role="form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="idFactura" value=" {{ $factura->id }}">
                                    <input type="hidden" name="tipoFactura" value=" {{ $factura->id_tipo_factura }}">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Codigo</th>
                                                <th>Descripcion</th>
                                                <th>Cantidad</th> {{-- Puedes añadir una columna para cantidad --}}
                                                <th>Monto</th> {{-- Puedes añadir una columna para cantidad --}}
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="selected-products-body">
                                            <!-- Aquí se añadirán las filas de productos dinámicamente -->
                                        </tbody>
                                    </table>

                                    <div class="col-md-12 mt20 mt-2">
                                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-plus-circle"></i></button>
                                    </div>
                                </form>
                     
                            </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Buscar producto para factura</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="buscar-producto" method="post">
            <input type="text" id="search-term" class="form-control" placeholder="Buscar producto" autofocus>
                                                
        </form>
        <div id="loading-message">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>

       <div id="search-results"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        
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
                    front:"facturas"

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
<script>
$(document).ready(function() {
    let productCounter = 0; // Para dar nombres únicos a los inputs en el formulario

    // Delegamos el evento 'click' a un elemento padre que siempre existe
    // porque los botones 'add-to-list-btn' se añaden dinámicamente.
    // Asumo que '#search-results-container' es el div que contiene la tabla de búsqueda.
    // Si tu tabla de búsqueda es #search-results, usa: $('#search-results').on('click', '.add-to-list-btn', function() {
    $('#search-results').on('click', '.add-to-list-btn', function() {
        const productId = $(this).data('productId');
        const productCodigo = $(this).data('productCodigo');
        const productStatus = $(this).data('productStatus');
        const productCantidad = $(this).data('productCantidad');
        const productDescripcion = $(this).data('productDescripcion');
        const productMonto= $(this).data('productMonto');

        // Validar si el producto ya está en la tabla de selección
        if ($('#selected-products-body').find(`input[name='selected_products[${productId}][id]']`).length > 0) {
            alert('¡Este producto ya ha sido agregado a la lista!');
            return; // Detener la ejecución si el producto ya está agregado
        }

        // Crear una nueva fila (<tr>) para la tabla de productos seleccionados
        const newRow = `
            <tr id="selected-product-row-${productId}">
                <td>
                    ${productId}
                    <input type="hidden" name="detalles_factura[${productId}][id_producto]" value="${productId}">
                </td>
                <td>
                    ${productCodigo}
                    <input type="hidden" name="detalles_factura[${productId}][id_status_producto_factura]" class="form-control form-control-sm product-quantity" value="1" >
                   
                    
                </td>
                <td>
                    ${productDescripcion}
                    
                </td>
                <td>
                
                    <input type="number" name="detalles_factura[${productId}][cantidad_producto_factura]" class="form-control form-control-sm product-quantity" value="1" min="1" max="${productCantidad}">
                </td>
                <td>
                 ${productMonto}
                    <input type="hidden" name="detalles_factura[${productId}][monto_producto_factura]" class="form-control form-control-sm product-quantity" value="${productMonto}" >
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-from-list-btn" data-product-id="${productId}"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
        `;

        // Añadir la nueva fila al tbody de la tabla de selección
        $('#selected-products-body').append(newRow);

        // Opcional: Deshabilitar el botón "Agregar" para este producto en la lista de búsqueda
        // para evitar añadirlo múltiples veces si el usuario no actualiza la búsqueda.
       $(this).prop('disabled', true).html('<i class="bi bi-check-lg"></i> ');
        $("#search-term").val("");
        // Opcional: Incrementar el contador si lo usas para nombres de inputs secuenciales
        // productCounter++;
    });

    // Evento para el botón "Eliminar" de la tabla de productos seleccionados
    $('#selected-products-body').on('click', '.remove-from-list-btn', function() {
        const productIdToRemove = $(this).data('productId');
        $(`#selected-product-row-${productIdToRemove}`).remove(); // Eliminar la fila

        // Habilitar el botón "Agregar" de nuevo en la lista de búsqueda si existe
        $(`#product-row-${productIdToRemove}`).find('.add-to-list-btn').prop('disabled', false).text('Agregar');
    });

    // Nota: Es importante que '#search-results' exista en tu HTML principal
    // y que el HTML de tu búsqueda se cargue dentro de él.
});
</script>
@endsection

