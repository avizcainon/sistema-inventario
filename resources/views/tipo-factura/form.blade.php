<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="descripcion_tipo_factura" class="form-label">{{ __('Descripcion Tipo Factura') }}</label>
            <input type="text" name="descripcion_tipo_factura" class="form-control @error('descripcion_tipo_factura') is-invalid @enderror" value="{{ old('descripcion_tipo_factura', $tipoFactura?->descripcion_tipo_factura) }}" id="descripcion_tipo_factura" placeholder="Descripcion Tipo Factura">
            {!! $errors->first('descripcion_tipo_factura', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>