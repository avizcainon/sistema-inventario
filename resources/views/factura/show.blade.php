@extends('layouts.app')

@section('template_title')
    {{ $factura->name ?? __('Show') . " " . __('Factura') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Factura</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('facturas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Cliente:</strong>
                                    {{ $factura->id_cliente }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Tipo Factura:</strong>
                                    {{ $factura->id_tipo_factura }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Status Factura:</strong>
                                    {{ $factura->id_status_factura }}
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

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Lista de') }} Productos</span>
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
                                <button type="submit" class="btn btn-primary">{{ __('Procesar') }}</button>
                            </div>
                        </form>
                        
                                

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Add') }} Productos</span>
                        </div>
                        <div class="float-right">
                            <div class="input-group mb-3">
                                <form id="buscar-producto" method="post">
                                    <input type="text" id="search-term" class="form-control" placeholder="Buscar producto" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    
                                </form>
                                
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div id="search-results">Resultados:</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <script>
        $(document).ready(function() {
            $('#search-term').on('keyup', function() {
            var searchTerm = $(this).val();
                
            $.ajax({
                url: '/buscar', // Ruta al controlador
                method: 'GET',
                data: { term: searchTerm,
                    front:"facturas"

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
                    <button type="button" class="btn btn-danger btn-sm remove-from-list-btn" data-product-id="${productId}">Eliminar</button>
                </td>
            </tr>
        `;

        // Añadir la nueva fila al tbody de la tabla de selección
        $('#selected-products-body').append(newRow);

        // Opcional: Deshabilitar el botón "Agregar" para este producto en la lista de búsqueda
        // para evitar añadirlo múltiples veces si el usuario no actualiza la búsqueda.
        $(this).prop('disabled', true).text('Agregado');
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

