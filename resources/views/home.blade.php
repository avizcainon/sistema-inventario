@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card color-secundario">
                <div class="card-header">{{ __('Reporte') }}</div>

                <div class="card-body bg-white">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}  {{ __('You are logged in!') }}
                        </div>
                    @endif

                   
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col">
                                    <a href="{{ route('productos.index') }}" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                        <h5 class="card-title text-secondary fs-3"> <i class="bi bi-patch-check"></i></h5>
                                        <p class="card-text fs-3 fw-bold text-info">{{ $totalProductos }}</p>
                                    </a>
                                     
                                                                    
                                </div>
                                
                                


                                <div class="col">
                                    <a href="{{ route('clientes.index') }}" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                        <h5 class="card-title text-secondary fs-3">  <i class="bi bi-person-fill"></i></h5>
                                    <p class="card-text fs-3 fw-bold text-info">{{ $totalClientes }}</p>
                                    </a>
                                    
                                                                    
                                </div>
                            </div>   
                        </div>
                    </div>
<br>
                    
                   
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('facturas.index') }}" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                        <h5 class="card-title text-secondary fs-3"> <i class="bi bi-journal"></i></h5>
                                        <p class="card-text fs-3 fw-bold text-info">{{ $totalFacturas }}</p> 
                                    </a>
                                                                      
                                </div>
                                <div class="col">
                                    <p class="card-text fs-3 fw-bold text-success"><i class="bi bi-journal-arrow-down"></i> {{ $totalFacturasCompras }}</p>
                                    <p class="card-text fs-3 fw-bold text-primary"><i class="bi bi-journal-arrow-up"></i> {{ $totalFacturasVentas }}</p>
                                    <p class="card-text fs-3 fw-bold text-danger"><i class="bi bi-journal-x"></i> {{ $totalFacturasDevolucion }}</p>                                   
                                </div>
                            </div>   
                        </div>
                    </div>
<br>
                    @if (Auth::user()->id_user_type == 1)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-secondary"><i class="bi bi-coin"></i> Inventario</h5>
                            
                            <div class="row">
                                <div class="col">
                                    <p class="card-text fs-3 fw-bold text-success" style="--bs-text-opacity: .5;">{{ $totalMontoVentaProductos }}</p>
                                    <h5 class="card-title text-secondary"><i class="bi bi-coin"></i> Valor de venta</h5>                              
                                </div>
                                <div class="col">
                                          <p class="card-text fs-3 fw-bold text-success" style="--bs-text-opacity: .5;">{{ $totalMontoCompraProductos }}</p>
                                         <h5 class="card-title text-secondary"><i class="bi bi-coin"></i> Valor de compra</h5>                          
                                </div>

                                <div class="col">
                                    @if ($totalMontoUtilidadProductos > 0)
                                        <p class="card-text fs-3 fw-bold text-success" >{{ $totalMontoUtilidadProductos}}</p>
                                    @else
                                        <p class="card-text fs-3 fw-bold text-danger" >{{ $totalMontoUtilidadProductos}}</p>
                                    @endif 
                                          
                                         <h5 class="card-title text-secondary"><i class="bi bi-coin"></i> Utilidad</h5>                          
                                </div>
                            </div>
                            
                             
                        </div>
                    </div>
                             

                    @endif 
                    



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
