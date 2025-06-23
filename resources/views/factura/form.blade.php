<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_cliente" class="form-label">{{ __('Buscar Cliente') }} </label>
            <div id="loading-message">
                <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

                            </div>
            <input type="text" id="buscador_cliente" class="form-control @error('id_cliente') is-invalid @enderror" value="{{ old('id_cliente', $factura?->id_cliente) }}" autocomplete="off" placeholder="Buscar por DNI, Nombre">
            {!! $errors->first('id_cliente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <input type="hidden" name="id_cliente" id="id_cliente" value="{{ old('id_cliente', $factura?->id_cliente) }}">
        
           
        </div>
        </div>
        
        <div class="form-group mb-2 mb20">
         
            <label for="id_tipo_factura" class="form-label">{{ __('Tipo Factura') }}</label>
            <select class="form-select" aria-label="Status del producto" name="id_tipo_factura">
                
                 @foreach ($tipos_factura as $tipo)
                    
                   
                    @if (Auth::user()->id_user_type == 2 && $tipo->id == 2)      
                        <option value="{{ $tipo->id }}">{{ $tipo->descripcion_tipo_factura	 }}</option>
                   
                    @endif

                    @if (Auth::user()->id_user_type == 1 )      
                        <option value="{{ $tipo->id }}">{{ $tipo->descripcion_tipo_factura	 }}</option>
                   
                    @endif
                   
                  @endforeach
                
            </select>
            
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_status_factura" class="form-label">{{ __('Status Factura') }}</label>
            <select class="form-select" aria-label="Status del producto" name="id_status_factura">
                
                 @foreach ($status_factura as $status)
                        @if (Auth::user()->id_user_type == 2 && $status->id == 2)      
                            <option value="{{ $status->id }}">{{ $status->descripcion_status_factura	 }}</option>
                    
                        @endif

                        @if (Auth::user()->id_user_type == 1 )      
                            <option value="{{ $status->id }}">{{ $status->descripcion_status_factura	 }}</option>
                    
                        @endif
                   
                  @endforeach
                
            </select>
           
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-outline-primary">{{ __('Submit') }}</button>
    </div>
</div>