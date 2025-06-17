<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//rutas para los clientes
Route::resource('clientes', App\Http\Controllers\ClienteController::class);
//rutas para los factura
Route::resource('facturas', App\Http\Controllers\FacturaController::class);
//rutas para los producto
Route::resource('productos', App\Http\Controllers\ProductoController::class);
//rutas para los detalles factura
Route::resource('detalles-facturas', App\Http\Controllers\DetallesFacturaController::class);
//rutas para los status producto
Route::resource('status-productos', App\Http\Controllers\StatusProductoController::class);

//rutas para los buscar producto

Route::get('buscar', [App\Http\Controllers\ProductoController::class, 'buscar']);
Route::get('buscar-cliente', [App\Http\Controllers\ClienteController::class, 'buscar']);
