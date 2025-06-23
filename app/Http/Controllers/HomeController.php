<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth')->except('logout');
        ##$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() : View
    {
        $totalProductos = Producto::count();
        $totalFacturas = Factura::count();
        $totalFacturasCompras = Factura::where('id_tipo_factura',1)->count();
        $totalFacturasVentas = Factura::where('id_tipo_factura',2)->count();
        $totalFacturasDevolucion = Factura::where('id_tipo_factura',3)->count();
        $totalMontoCompraProductos = Producto::sum('monto_producto_compra');
        $totalMontoVentaProductos = Producto::sum('monto_producto_venta');
        $totalMontoUtilidadProductos = $totalMontoVentaProductos - $totalMontoCompraProductos;
        $totalClientes = Cliente::count();
        Log::info("********************************************************************* Cantidad de producto: {$totalProductos}");
        return view('home', compact('totalProductos','totalFacturas',
        'totalClientes','totalFacturasCompras','totalFacturasVentas',
        'totalFacturasDevolucion','totalMontoCompraProductos','totalMontoVentaProductos','totalMontoUtilidadProductos'));
    }
}
