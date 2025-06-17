<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_factura" class="form-label">{{ __('Id Factura') }}</label>
            <input type="text" name="id_factura" class="form-control @error('id_factura') is-invalid @enderror" value="{{ old('id_factura', $detallesFactura?->id_factura) }}" id="id_factura" placeholder="Id Factura">
            {!! $errors->first('id_factura', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_producto" class="form-label">{{ __('Id Producto') }}</label>
            <input type="text" name="id_producto" class="form-control @error('id_producto') is-invalid @enderror" value="{{ old('id_producto', $detallesFactura?->id_producto) }}" id="id_producto" placeholder="Id Producto">
            {!! $errors->first('id_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_status_producto_factura" class="form-label">{{ __('Id Status Producto Factura') }}</label>
            <input type="text" name="id_status_producto_factura" class="form-control @error('id_status_producto_factura') is-invalid @enderror" value="{{ old('id_status_producto_factura', $detallesFactura?->id_status_producto_factura) }}" id="id_status_producto_factura" placeholder="Id Status Producto Factura">
            {!! $errors->first('id_status_producto_factura', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cantidad_producto_factura" class="form-label">{{ __('Cantidad Producto Factura') }}</label>
            <input type="text" name="cantidad_producto_factura" class="form-control @error('cantidad_producto_factura') is-invalid @enderror" value="{{ old('cantidad_producto_factura', $detallesFactura?->cantidad_producto_factura) }}" id="cantidad_producto_factura" placeholder="Cantidad Producto Factura">
            {!! $errors->first('cantidad_producto_factura', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="monto_producto_factura" class="form-label">{{ __('Monto Producto Factura') }}</label>
            <input type="text" name="monto_producto_factura" class="form-control @error('monto_producto_factura') is-invalid @enderror" value="{{ old('monto_producto_factura', $detallesFactura?->monto_producto_factura) }}" id="monto_producto_factura" placeholder="Monto Producto Factura">
            {!! $errors->first('monto_producto_factura', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>