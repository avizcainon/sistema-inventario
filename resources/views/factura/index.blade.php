@extends('layouts.app')

@section('template_title')
    Facturas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Facturas') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('facturas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                                        <th>No</th>
                                        
									
									<th >Tipo Factura</th>
									<th >Status Factura</th>
                                    <th >DNI Cliente</th>
                                    <th >Cliente</th>
                                    <th >Fecha</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facturas as $factura)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td >{{ $factura->tipoFactura->descripcion_tipo_factura	 }}</td>
                                            <td >{{ $factura->statusFactura->descripcion_status_factura	 }}</td>
                                            <td >{{ $factura->cliente->dni }}</td>
                                            <td >{{ $factura->cliente->nombre }} {{ $factura->cliente->apellido }}</td>
                                            <td >{{ $factura->created_at }}</td>

                                            <td>
                                                <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('facturas.show', $factura->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    {{-- <a class="btn btn-sm btn-success" href="{{ route('facturas.edit', $factura->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a> --}}
                                                    
                                                    @if (Auth::user()->id_user_type == 1)
                                                         @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>

                                                    @endif
                                                    <a class="btn btn-sm btn-secondary " href="{{ route('detalles-facturas.show', $factura->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Detalle') }}</a>
                                                    
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
