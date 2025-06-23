@if ($productos->isEmpty())
   No se encontraron productos que coincidan con la búsqueda.
@else

    <table class="table table-striped table-hover">
        <thead class="thead">
            <tr>
                                      
                <th>Imagen </th>  
                <th>Codigo </th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                @if (Auth::user()->id_user_type == 1)
                    <th>Monto Compra</th>
                @endif
                                        
                <th>Monto Venta</th>
                <th>Medida</th>
                <th>Status</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                {{ $producto->status_productos }}
                    <tr>
                        <td>
                            @if ($producto->imagen_producto)
                                @if(str_starts_with($producto->imagen_producto, 'https') || str_starts_with($producto->imagen_producto, 'http'))
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalProducto{{ $producto->codigo_producto }}">
                                    <img src="{{ $producto->imagen_producto }}" class="rounded float-start" id="imagen_producto" alt="Imagen producto" width="100">
                                </a>    
                                
                                @else
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalProducto{{ $producto->codigo_producto }}">
                                        <img src="{{ asset('imagenes/' . $producto->imagen_producto) }}" class="rounded float-start" id="imagen_producto" alt="Imagen producto" width="100">
                                    </a>
                                    
                                @endif              
                            @else
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalProducto{{ $producto->codigo_producto }}">
                                <img src="{{ asset('imagenes/producto-generico.webp' ) }}" class="rounded float-start" id="imagen_producto" alt="Imagen producto" width="100">
                            </a>
                                
                            @endif 
                                            
                        </td>
                        <td >{{ $producto->codigo_producto }}</td>
                        <td >{{ $producto->descripcion_producto }}</td>
                        <td >{{$producto->cantidad_producto}}</td>
                        @if (Auth::user()->id_user_type == 1)
                            <td >{{ $producto->monto_producto_compra }}</td>
                        @endif                
                        <td >{{ $producto->monto_producto_venta }}</td>
                        <td >{{ $producto->medida_producto }}</td>
                        <td >{{ $producto->statusProducto->descripcion_status_producto }}</td>
                        <td>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                @if ($front == "productos")
                                    <a class="btn btn-sm btn-outline-primary " href="{{ route('productos.show', $producto->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                    <a class="btn btn-sm btn-outline-success" href="{{ route('productos.edit', $producto->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                    @if (Auth::user()->id_user_type == 1)
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>               
                                    @endif
                                @endif                  
                                @if ($front == "facturas")
                                    <button
                                        type="button"
                                        class="btn btn-outline-primary btn-sm add-to-list-btn" {{-- Clase para identificar con jQuery --}}
                                        data-product-id="{{ $producto->id }}"
                                        data-product-codigo="{{ $producto->codigo_producto }}"
                                        data-product-cantidad="{{ $producto->cantidad_producto }}"
                                        data-product-monto="{{ $producto->monto_producto_venta }}"
                                        data-product-descripcion="{{ $producto->descripcion_producto ?? 'N/A' }}">
                                        Agregar
                                    </button>
                                @endif
                                                        
                            </form>
                        </td>
                        <td >
                            <div class="modal fade" id="modalProducto{{ $producto->codigo_producto }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $producto->codigo_producto }} {{ $producto->descripcion_producto }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
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
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </td>
                        
<!-- Modal -->
                        
                        




                    </tr>
            @endforeach
        </tbody>
    </table>
    
@endif