<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="descripcion_status_producto_factura" class="form-label">{{ __('Descripcion Status Producto Factura') }}</label>
            <input type="text" name="descripcion_status_producto_factura" class="form-control @error('descripcion_status_producto_factura') is-invalid @enderror" value="{{ old('descripcion_status_producto_factura', $statusProductoFactura?->descripcion_status_producto_factura) }}" id="descripcion_status_producto_factura" placeholder="Descripcion Status Producto Factura">
            {!! $errors->first('descripcion_status_producto_factura', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>