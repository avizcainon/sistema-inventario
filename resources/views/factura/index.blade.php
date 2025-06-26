@extends('layouts.app')

@section('template_title')
    Facturas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card color-secundario">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Facturas') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('facturas.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                 <i class="bi bi-file-earmark-plus"></i>
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th class="color-principal">No</th>
                                        
									
									<th class="color-principal">Tipo Factura</th>
									<th class="color-principal">Status Factura</th>
                                    <th class="color-principal">DNI Cliente</th>
                                    <th class="color-principal">Cliente</th>
                                    <th class="color-principal">Fecha</th>

                                        <th class="color-principal"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facturas as $factura)
                                        <tr>
                                            <td>{{ $factura->id }}</td>
                                            <td >{{ $factura->tipoFactura->descripcion_tipo_factura	 }}</td>
                                            <td >{{ $factura->statusFactura->descripcion_status_factura	 }}</td>
                                            <td >{{ $factura->cliente->dni }}</td>
                                            <td >{{ $factura->cliente->nombre }} {{ $factura->cliente->apellido }}</td>
                                            <td >{{ $factura->created_at }}</td>

                                            <td>
                                                <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST">
                                                        
                                                
                                                
                                                
                                                    {{-- <a class="btn btn-sm btn-outline-success" href="{{ route('facturas.edit', $factura->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a> --}}
                                                    
                                                    @if (Auth::user()->id_user_type == 1)
                                                         @csrf
                                                        @method('DELETE')
                                                       
                                                        <a class="btn btn-sm btn-outline-primary " href="{{ route('facturas.show', $factura->id) }}"><i class="bi bi-eye"></i></a>
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="bi bi-trash"></i></button>
                                                       
                                                        
                                                      @else
                                                        @if ($factura->statusFactura->id == 1)
                                                            <a class="btn btn-sm btn-outline-primary " href="{{ route('facturas.show', $factura->id) }}"><i class="bi bi-eye"></i></a>
                                                            
                                                        @endif

                                                    @endif

                                                    


                                                    <a class="btn btn-sm btn-outline-secondary " href="{{ route('detalles-facturas.show', $factura->id) }}"><i class="bi bi-card-list"></i></a>
                                                    
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $facturas->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
