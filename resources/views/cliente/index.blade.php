@extends('layouts.app')

@section('template_title')
    Clientes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card color-secundario">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Clientes') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('clientes.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  <i class="bi bi-person-add"></i>
                                </a>
                              </div>
                        </div>
                    </div>
                    
                    @if (session('success'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    
                    @endif

                    @if ($errors->any() || session('error'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                           @if (session('error'))
                                        <p>{{ session('error') }}</p> {{-- ¡Esta línea mostrará el mensaje de conexión! --}}
                                    @endif
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>Error al registrar cliente: </strong>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									    <th>Dni</th>
									    <th>Nombre</th>
									    <th>Apellido</th>
									    <th>Telefono</th>
									    <th>Correo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->id }}</td>
                                            
										<td >{{ $cliente->dni }}</td>
										<td >{{ $cliente->nombre }}</td>
										<td >{{ $cliente->apellido }}</td>
										<td >{{ $cliente->telefono }}</td>
										<td >{{ $cliente->correo }}</td>

                                            <td>
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-outline-primary " href="{{ route('clientes.show', $cliente->id) }}"><i class="bi bi-eye"></i></a>
                                                    <a class="btn btn-sm btn-outline-success" href="{{ route('clientes.edit', $cliente->id) }}"><i class="bi bi-pencil-square"></i></a>
                                                    @if (Auth::user()->id_user_type == 1)
                                                         @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="bi bi-trash"></i></button>

                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection
