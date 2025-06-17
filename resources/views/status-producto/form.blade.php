<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="descripcion_status_producto" class="form-label">{{ __('Descripcion Status Producto') }}</label>
            <input type="text" name="descripcion_status_producto" class="form-control @error('descripcion_status_producto') is-invalid @enderror" value="{{ old('descripcion_status_producto', $statusProducto?->descripcion_status_producto) }}" id="descripcion_status_producto" placeholder="Descripcion Status Producto">
            {!! $errors->first('descripcion_status_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>