<div class="row padding-1 p-1">
    <div class="col-md-12">
        
     <div class="form-group mb-2 mb20">
            <label for="imagen_producto" class="form-label">{{ __('Imagen Producto') }}</label>
            <input type="file" name="imagen_producto" class="form-control @error('imagen_producto') is-invalid @enderror" value="{{ old('imagen_producto', $producto?->imagen_producto) }}" id="imagen_producto_file" placeholder="Imagen Producto">
            {!! $errors->first('imagen_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div>
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


        </div>
         
    <div class="form-group mb-2 mb20">
            <label for="codigo_producto" class="form-label">{{ __('Codigo Producto') }}</label>
            <input type="text" name="codigo_producto" class="form-control @error('codigo_producto') is-invalid @enderror" value="{{ old('codigo_producto', $producto?->codigo_producto) }}" id="codigo_producto" placeholder="Codigo Producto">
            {!! $errors->first('codigo_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion_producto" class="form-label">{{ __('Descripcion Producto') }}</label>
            <input type="text" name="descripcion_producto" class="form-control @error('descripcion_producto') is-invalid @enderror" value="{{ old('descripcion_producto', $producto?->descripcion_producto) }}" id="descripcion_producto" placeholder="Descripcion Producto">
            {!! $errors->first('descripcion_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cantidad_producto" class="form-label">{{ __('Cantidad Producto') }}</label>
            <input type="text" name="cantidad_producto" class="form-control @error('cantidad_producto') is-invalid @enderror" value="{{ old('cantidad_producto', $producto?->cantidad_producto) }}" id="cantidad_producto" placeholder="Cantidad Producto">
            {!! $errors->first('cantidad_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="monto_producto_compra" class="form-label">{{ __('Monto Producto Compra') }}</label>
            <input type="text" name="monto_producto_compra" class="form-control @error('monto_producto_compra') is-invalid @enderror" value="{{ old('monto_producto_compra', $producto?->monto_producto_compra) }}" id="monto_producto_compra" placeholder="Monto Producto Compra">
            {!! $errors->first('monto_producto_compra', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="monto_producto_venta" class="form-label">{{ __('Monto Producto Venta') }}</label>
            <input type="text" name="monto_producto_venta" class="form-control @error('monto_producto_venta') is-invalid @enderror" value="{{ old('monto_producto_venta', $producto?->monto_producto_venta) }}" id="monto_producto_venta" placeholder="Monto Producto Venta">
            {!! $errors->first('monto_producto_venta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="medida_producto" class="form-label">{{ __('Medida Producto') }}</label>
            <input type="text" name="medida_producto" class="form-control @error('medida_producto') is-invalid @enderror" value="{{ old('medida_producto', $producto?->medida_producto) }}" id="medida_producto" placeholder="Medida Producto">
            {!! $errors->first('medida_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
       
            
        <div class="form-group mb-2 mb20">
            <label for="id_status_producto" class="form-label">{{ __('Status Producto') }}</label>
            <select class="form-select" aria-label="Status del producto" name="id_status_producto">
                
                 @foreach ($status_productos as $status)
                    <option value="{{ $status->id }}">{{ $status->descripcion_status_producto	 }}</option>
                  @endforeach
                
            </select>
           
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-outline-dark"><i class="bi bi-plus-circle"></i></button>
    </div>
</div>

<script>
    $(document).ready(function(e){

        $('#imagen_producto_file').change(function(){

            let reader = new FileReader();
            reader.onload = (e)=>{
                $('#imagen_producto').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

});
</script>